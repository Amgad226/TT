<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function store($image, $name, $path = "", $lessQuality = true)
    {
        $extension = $image->getClientOriginalExtension();
        $imageResize = Image::make($image->getRealPath())->encode($extension);

        if ($lessQuality) {
            // Optionally compress or resize the image here
        }

        $uniqueName = $name . uniqid() . '.' . $extension;
        $fullPath = trim($path, '/') . '/' . $uniqueName;

        if (config('app.storeGoogleDrive')) {
            $disk = Storage::disk('google');
            $disk->put($fullPath, (string) $imageResize, ['visibility' => 'public']);
            
            // Construct Google Drive link directly without extra metadata calls
            // $fileId = $disk->getAdapter()->getMetadata($fullPath)['id'];
            $fileId  = $disk
            ->getAdapter()
            ->getMetadata($fullPath)
            ->extraMetadata()['id'];
            $link = "https://lh3.googleusercontent.com/d/$fileId";

            // $link = "https://drive.google.com/uc?id={$fileId}&export=view";
        } else {
            $storagePath = public_path($fullPath);
            if (!File::isDirectory(dirname($storagePath))) {
                File::makeDirectory(dirname($storagePath), 0755, true);
            }
            $imageResize->save($storagePath);
            $link = asset($fullPath);
        }

        return $link;
    }
}
