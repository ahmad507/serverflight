<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:4|max:255'
        ];
    }
    
    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'validation errors',
            'status code' => 401,
            'data'      => $validator->errors()
        ]));
    }
    
    /**
     * @return array
     */
    public function messages()
    {
        return [
            'username.unique' => 'Yah....username yang kamu inginkan sudah pakai',
            'email.unique' => 'Yah....email yang kamu gunakan sudah terdaftar',
        ];
    }
}
