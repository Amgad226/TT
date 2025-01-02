<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeMessageRequest extends AllRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return  [

            'body' => ['string'],//attachment , audio
            'type'=>['required'],
            'attachment'=>'max:15000|mimes:doc,docx,mp3,m4a,mp4,wav,pdf,html,jpeg,png,jpg,PNG,JPG,JPEG,webp',
            'img'=> 'mimes:jpeg,png,jpg,PNG,JPG,JPEG,webp',

        ];
    }
}
