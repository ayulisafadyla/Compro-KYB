<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAboutImage;
use Illuminate\Http\Request;
use App\Traits\HandleImageUpload;

class HomeAboutImageController extends Controller
{
    use HandleImageUpload;

    public function edit()
    {
        $aboutImage = HomeAboutImage::first() ?? new HomeAboutImage();
        return view('admin.home-about-images.edit', compact('aboutImage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $aboutImage = HomeAboutImage::first() ?? new HomeAboutImage();

        if ($request->hasFile('image')) {
            if ($aboutImage->image) {
                $this->deleteImage($aboutImage->image);
            }
            $aboutImage->image = $this->uploadAndConvertToWebp($request->file('image'), 'home');
        }

        $aboutImage->save();

        return redirect()->back()->with('success', 'Foto Company Images Berhasil Diperbarui.');
    }
}
