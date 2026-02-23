<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleImageUpload;

class BrandController extends Controller
{
    use HandleImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('order')->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|url',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->uploadAndConvertToWebp($request->file('logo'), 'brands');
        }

        $brand = Brand::create($validated);

        ActivityLog::log('CREATED', 'Brands', 'Created brand: ' . $brand->name);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|url',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $this->deleteImage($brand->logo);
            $validated['logo'] = $this->uploadAndConvertToWebp($request->file('logo'), 'brands');
        }

        $brand->update($validated);

        ActivityLog::log('UPDATED', 'Brands', 'Updated brand: ' . $brand->name);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->deleteImage($brand->logo);
        $brandName = $brand->name;
        $brand->delete();

        ActivityLog::log('DELETED', 'Brands', 'Deleted brand: ' . $brandName);

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
