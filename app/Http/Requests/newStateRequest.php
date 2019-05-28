<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newStateRequest extends FormRequest
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
            'name_en'          =>  'required|string|min:2|Regex:/[a-z]/i|unique:states,name_en',
            'name_ar'          =>  'required|string|min:2|Regex:/[أ-ي]/|unique:states,name_ar',
            'country_id'    =>  'required|numeric|min:1|exists:countries,id'
        ];
    }
}
