<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newPackageRequest extends FormRequest
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
            'name_en'          =>  'required|string|min:2|Regex:/[a-z]/i|unique:packages,name_en',
            'description_en'   =>  'required|string|Regex:/[a-z]/i|min:5',
            'name_ar'          =>  'required|string|min:2|Regex:/[أ-ي]/|unique:packages,name_ar',
            'description_ar'   =>  'required|string|Regex:/[أ-ي]/|min:5',
            'points'        =>  'required|numeric|min:0',
        ];
    }
}
