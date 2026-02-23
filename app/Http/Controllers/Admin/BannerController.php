<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandleImageUpload;

class BannerController extends Controller
{
    use HandleImageUpload;

    public function index()
    {
        $banners = \App\Models\Banner::orderBy('order')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'banners');
        }

        $validated['is_active'] = $request->has('is_active');

        \App\Models\Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    public function show(\App\Models\Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(\App\Models\Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, \App\Models\Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($banner->image);
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'banners');
        }

        $validated['is_active'] = $request->has('is_active');

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy(\App\Models\Banner $banner)
    {
        $this->deleteImage($banner->image);

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
