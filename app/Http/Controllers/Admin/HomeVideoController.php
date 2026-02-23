<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HandleImageUpload;
use Illuminate\Http\Request;

class HomeVideoController extends Controller
{
    use HandleImageUpload;

    public function index()
    {
        $videos = \App\Models\HomeVideo::latest()->get();
        return view('admin.home-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.home-videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'video_url' => 'required|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $data = $request->only(['title', 'subtitle', 'video_url']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $this->uploadAndConvertToWebp($request->file('background_image'), 'home/videos');
        }

        // If this is set to active, deactivate others
        if ($data['is_active']) {
            \App\Models\HomeVideo::where('is_active', true)->update(['is_active' => false]);
        }

        \App\Models\HomeVideo::create($data);

        return redirect()->route('admin.home-videos.index')->with('success', 'Video Banner created successfully.');
    }

    public function edit(\App\Models\HomeVideo $homeVideo)
    {
        return view('admin.home-videos.edit', compact('homeVideo'));
    }

    public function update(Request $request, \App\Models\HomeVideo $homeVideo)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'video_url' => 'required|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $data = $request->only(['title', 'subtitle', 'video_url']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            if ($homeVideo->background_image) {
                $this->deleteImage($homeVideo->background_image);
            }
            $data['background_image'] = $this->uploadAndConvertToWebp($request->file('background_image'), 'home/videos');
        }

        if ($data['is_active']) {
            \App\Models\HomeVideo::where('id', '!=', $homeVideo->id)->where('is_active', true)->update(['is_active' => false]);
        }

        $homeVideo->update($data);

        return redirect()->route('admin.home-videos.index')->with('success', 'Video Banner updated successfully.');
    }

    public function destroy(\App\Models\HomeVideo $homeVideo)
    {
        if ($homeVideo->background_image) {
            $this->deleteImage($homeVideo->background_image);
        }
        $homeVideo->delete();
        return redirect()->route('admin.home-videos.index')->with('success', 'Video Banner deleted successfully.');
    }
}
