<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleImageUpload;

class AboutSectionController extends Controller
{
    use HandleImageUpload;

    public function index()
    {
        $aboutSections = AboutSection::orderBy('order')->paginate(15);
        return view('admin.about-sections.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('admin.about-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'about-sections');
        }

        $validated['is_active'] = $request->has('is_active');

        AboutSection::create($validated);

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section created successfully.');
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('admin.about-sections.edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($aboutSection->image);
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'about-sections');
        }

        $validated['is_active'] = $request->has('is_active');

        $aboutSection->update($validated);

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutSection $aboutSection)
    {
        $this->deleteImage($aboutSection->image);
        $aboutSection->delete();
        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section deleted successfully.');
    }
}
