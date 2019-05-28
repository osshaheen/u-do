<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateServiceTypeRequest extends FormRequest
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
            'point_type_id' =>  'required|min:1|exists:point_types,id',
            'name_en'          =>  'required|string|min:1|regex:/[a-z]/i|unique:service_types,name_en,'.$this->id,
            'description_en'   =>  'required|string|regex:/[a-z]/i|min:5',
            'name_ar'          =>  'required|string|min:1|regex:/[أ-ي]/|unique:service_types,name_ar,'.$this->id,
            'description_ar'   =>  'required|string|min:5|regex:/[أ-ي]/',
            'price'         =>  'required|numeric|min:0.01',
        ];
    }
}
