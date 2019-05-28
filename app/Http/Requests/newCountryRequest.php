<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newCountryRequest extends FormRequest
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
            'name_en'  =>  'required|string|min:2|unique:countries,name_en|Regex:/[a-z]/i',
            'name_ar'  =>  'required|string|min:2|unique:countries,name_ar|Regex:/[أ-ي]/'
        ];
    }
}
