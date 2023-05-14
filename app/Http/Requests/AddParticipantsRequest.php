<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UsersIdRule;
use Illuminate\Foundation\Http\FormRequest;

class AddParticipantsRequest extends AllRequest

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
        return 
          [  'conversation_id'=>['required','exists:conversations,id'],
          
             'users_id'=> ['required',
                              function ($attribute, $value, $fail) {
                                  $values =explode(",", $value);
                                  foreach($values as $a){
                                      if( ! User::where('id',$a)->exists())
                                      $fail('The '.$attribute.' is invalid.');
                                  }
                              },
                          ]
          ];
    }
}
