<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleImageUpload;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    use HandleImageUpload;

    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage' => 'nullable|string',
            'features' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->name) . '-' . time();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'products');
        }

        $validated['is_active'] = $request->has('is_active');

        // Convert features string to array
        if ($request->filled('features')) {
            $validated['features'] = array_map('trim', explode(',', $request->features));
        }

        $product = Product::create($validated);

        ActivityLog::log('CREATED', 'Products', 'Created product: ' . $product->name);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage' => 'nullable|string',
            'features' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'products');
        }

        if ($request->name !== $product->name) {
            $validated['slug'] = Str::slug($request->name) . '-' . time();
        }

        $validated['is_active'] = $request->has('is_active');

        // Convert features string to array
        if ($request->filled('features')) {
            $validated['features'] = array_map('trim', explode(',', $request->features));
        } else {
            $validated['features'] = null;
        }

        $product->update($validated);

        ActivityLog::log('UPDATED', 'Products', 'Updated product: ' . $product->name);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete image
        $this->deleteImage($product->image);

        $productName = $product->name;
        $product->delete();

        ActivityLog::log('DELETED', 'Products', 'Deleted product: ' . $productName);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
