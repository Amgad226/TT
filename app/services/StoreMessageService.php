<?php
namespace App\services;

use Illuminate\Support\Facades\File;
use Image;

use Illuminate\Support\Facades\Storage;

class StoreMessageService {

    public $request;

    public function __construct($request){
        $this->request=$request;

    }


    public function storeMessage(){
        $attachment='';
        if($this->request->type=='text'){
            $message=$this->text();
        }

        else if($this->request->type=='audio')  {
            $message=$this->audio();
        }

        else if($this->request->type=='attachment')   {
            $attachment=$this->attachment();
            $message=  $attachment['link_attachment'] ;
        }

        else if($this->request->type=='img'){
            $message=$this->image();

        }
        return [
            'message'=>$message,
            'attachment'=>$attachment
        ];
        // return $message;


    }
    public function text(){
        return $this->request->body;
    }
    public function audio(){
        return $this->request->body;

    }

    public function image(){
        $image= $this->request->img;
        $body=$image;
        $name=$body->getClientOriginalName();
        $extension=$body->getclientoriginalextension();

        $image_resize = Image::make($body->getRealPath())->encode($extension);;
        // $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
        $image_resize->resize(600, 300, function ($constraint) {$constraint->aspectRatio(); });

        $uniqid=uniqid();

        if(config('app.storeGoogleDrive')==true){

        Storage::disk('google')->put('image/'.$name.$uniqid.'.'.$extension ,$image_resize,  );
        $link_attachment = Storage::disk('google')->url('image/'.$name.$uniqid.'.'.$extension);
        }
        else{

           if(! File::isDirectory(public_path('image')))
            File::makeDirectory(public_path('image'));

            $image_resize->save(public_path('image/'.$name.$uniqid.'.'.$extension));
            $link_attachment='image/'.$name.$uniqid.'.'.$extension;
            // dd(2);
        }

        return $link_attachment;


    }
    public function attachment(){
        $attachment= $this->request->attachment;

        $size=(int) (($attachment->getSize())/1000);
        $stringSize=$size.'KB';
        if($size>1000){
            $size/=1000;
            $stringSize=$size.'MB';
        }

        $uniqid=uniqid();

        $name=$attachment->getClientOriginalName();
        $extension=$attachment->getclientoriginalextension();

        if(config('app.storeGoogleDrive')==true){
            $a= Storage::disk('google')->put('attachment',$attachment  );
            $link_attachment = Storage::disk('google')->url($a);
        }
        else
        $link_attachment = $attachment->move('attachments',$name.$uniqid.'.'.$extension);


       return  [
            'link_attachment'=>(string)$link_attachment,
            'stringSize'=>$stringSize,
            'name'=>$name,
        ];

    }



}
