<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends AllRequest
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
            // 'message' => ['required', 'string'],

            'users_id*' => [],
            'groupName'=>['required'],
            'groupDescription'=>['required'],
            'img'=>'mimes:jpg,png,jpeg,gif,svg|max:2048',
            // 'img'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ];
    }
}
