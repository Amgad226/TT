<?php

namespace App\services;

use Illuminate\Support\Facades\File;
use Image;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function store($image, $name, $path = "", $lessQuality = true)
    {

        $extension = $image->getclientoriginalextension();


        $image_resize = Image::make($image->getRealPath())->encode($extension);

        if ($lessQuality) {
            // $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
            // $image_resize->resize(600, 300, function ($constraint) {$constraint->aspectRatio(); });
        }

        $uniqid = uniqid();

        $path_to_store  = $path . '/' . $name . $uniqid . '.' . $extension;
        if (config('app.storeGoogleDrive') == true) {
            $image = Storage::disk('google')->put($path_to_store, $image_resize);
            Storage::disk('google')->setVisibility($path_to_store, "public");

            $image_meta  = Storage::disk("google")
                ->getAdapter()
                ->getMetadata($path_to_store)
                ->extraMetadata();

            $image_id = $image_meta['id'];
            // FIXME must store just google drive file id in database and add the correct suffix in the resource   
            $link = "https://lh3.googleusercontent.com/d/$image_id";

            // $link = Storage::disk('google')->url($path_to_store);
        } else {
            if (! File::isDirectory(public_path($path_to_store)))
                File::makeDirectory(public_path($path_to_store));
            $image_resize->save(public_path($path_to_store));
            $link = $path_to_store;
        }

        return $link;
    }
}
