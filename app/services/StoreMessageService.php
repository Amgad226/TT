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
 


    }
    public function text(){
        return $this->request->body;
    }
    public function audio(){
        return $this->request->body;

    }

    public function image(){
        // dd($this->request);
        return ImageService::store( $this->request->img ,$this->request->img->getClientOriginalName(),'image');
    }
    public function attachment(){
        $attachment= $this->request->attachment;
        $name=$attachment->getClientOriginalName();
        $link_attachment=ImageService::store($attachment , $name,'attachments',false);

        $size=(int) (($attachment->getSize())/1000);
        $stringSize=$size.'KB';
        if($size>1000){
            $size/=1000;
            $stringSize=$size.'MB';
        }
       return  [
            'link_attachment'=>(string)$link_attachment,
            'stringSize'=>$stringSize,
            'name'=>$name,
        ];

    }



}
