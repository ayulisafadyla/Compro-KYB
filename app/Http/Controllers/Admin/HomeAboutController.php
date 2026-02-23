<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandleImageUpload;

class HomeAboutController extends Controller
{
    use HandleImageUpload;

    public function index()
    {
        $abouts = \App\Models\HomeAbout::orderBy('order')->get();
        return view('admin.home-abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.home-abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:sejarah,visi-misi',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'home/about');
        }

        \App\Models\HomeAbout::create($data);

        return redirect()->route('admin.home-abouts.index')->with('success', 'About Section created successfully.');
    }

    public function edit(\App\Models\HomeAbout $homeAbout)
    {
        return view('admin.home-abouts.edit', compact('homeAbout'));
    }

    public function update(Request $request, \App\Models\HomeAbout $homeAbout)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:sejarah,visi-misi',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $this->deleteImage($homeAbout->image);
            $data['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'home/about');
        }

        $homeAbout->update($data);

        return redirect()->route('admin.home-abouts.index')->with('success', 'About Section updated successfully.');
    }

    public function destroy(\App\Models\HomeAbout $homeAbout)
    {
        $this->deleteImage($homeAbout->image);
        $homeAbout->delete();
        return redirect()->route('admin.home-abouts.index')->with('success', 'About Section deleted successfully.');
    }
}
