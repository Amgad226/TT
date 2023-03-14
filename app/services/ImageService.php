<?php
namespace App\services;

use Illuminate\Support\Facades\File;
use Image;

use Illuminate\Support\Facades\Storage;

class ImageService {
    public static function store($image, $name,$path="" ,$lessQuality=true){
       
        $extension=$image->getclientoriginalextension();


        $image_resize = Image::make($image->getRealPath())->encode($extension);

        if($lessQuality){
            // $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
            $image_resize->resize(600, 300, function ($constraint) {$constraint->aspectRatio(); });
        }

        $uniqid=uniqid();

        if(config('app.storeGoogleDrive')==true){
            Storage::disk('google')->put($path.'/'.$name.$uniqid.'.'.$extension ,$image_resize,  );
            $link = Storage::disk('google')->url($path.'/'.$name.$uniqid.'.'.$extension);
        }else{
           if(! File::isDirectory(public_path($path)))
            File::makeDirectory(public_path($path));
            $image_resize->save(public_path($path.'/'.$name.$uniqid.'.'.$extension));
            $link=$path.'/'.$name.$uniqid.'.'.$extension;
        }

        return $link;

    }
}
