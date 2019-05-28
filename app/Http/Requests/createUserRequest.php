<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
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
            'username_en'          =>  'required|min:5|string|regex:/[a-z]/i',
            'username_ar'          =>  'required|min:5|string|regex:/[أ-ي]/',
            'phone'                =>  'required|min:8|numeric|unique:users',
            'email'                =>  'sometimes|min:1|email|nullable',
            'language'             =>  'required|in:en,ar',
            'provider_name_en'     =>  'sometimes|min:1|string|nullable|regex:/[a-z]/i',
            'provider_name_ar'     =>  'sometimes|min:1|string|nullable|regex:/[أ-ي]/',
            'password'             =>  'required|string|min:8|confirmed'
        ];
    }
}
