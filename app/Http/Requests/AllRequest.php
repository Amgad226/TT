<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AllRequest extends FormRequest
{
  
    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['message' => $validator->errors()->first(),'status'=>0], 400);
        throw new ValidationException($validator, $response);
    }
}
