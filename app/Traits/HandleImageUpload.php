<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandleImageUpload
{
    /**
     * Convert and store an image as WebP.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param int $quality
     * @return string
     */
    protected function uploadAndConvertToWebp($file, $directory, $quality = 80)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $filename . '_' . time() . '.webp';
        $path = storage_path('app/public/' . $directory . '/' . $newFilename);

        // Ensure directory exists
        if (!file_exists(storage_path('app/public/' . $directory))) {
            mkdir(storage_path('app/public/' . $directory), 0755, true);
        }

        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'png':
                $image = imagecreatefrompng($file);
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'webp':
                $image = imagecreatefromwebp($file);
                break;
            case 'gif':
                $image = imagecreatefromgif($file);
                break;
            default:
                // If it's something else (like svg), just store it normally
                return $file->store($directory, 'public');
        }

        imagewebp($image, $path, $quality);
        imagedestroy($image);

        return $directory . '/' . $newFilename;
    }

    /**
     * Delete an image from storage.
     *
     * @param string|null $path
     * @return void
     */
    protected function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
