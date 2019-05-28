<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newPlaceBranchRequest extends FormRequest
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
            'name_en'          =>  'required|string|min:2|Regex:/[a-z]/i|unique:place_branches,name_en',
            'name_ar'          =>  'required|string|min:2|Regex:/[أ-ي]/|unique:place_branches,name_ar',
            'place_id'         =>  'required|numeric|min:1|exists:places,id',
            'property_en'      =>  'sometimes|array|min:1',
            'property_en.*'    =>  'sometimes|string|Regex:/[a-z]/i|min:1|nullable',
            'value_en'         =>  'sometimes|array|min:1',
            'value_en.*'       =>  'sometimes|string|Regex:/[a-z]/i|min:1|nullable',
            'property_ar'      =>  'sometimes|array|min:1',
            'property_ar.*'    =>  'sometimes|string|Regex:/[أ-ي]/|min:1|nullable',
            'value_ar'         =>  'sometimes|array|min:1',
            'value_ar.*'       =>  'sometimes|string|Regex:/[أ-ي]/|min:1|nullable',
        ];
    }
}
