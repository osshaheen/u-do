<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCategoryRequest extends FormRequest
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
//        dd($this->id);
        return [
            'service_type_id'   =>'sometimes|numeric|min:0|exists:service_types,id|nullable',
            'root_id'           =>'sometimes|numeric|min:0|exists:categories,id|nullable',
            'parent_id'         =>'sometimes|numeric|min:0|exists:categories,id|nullable',
            'level'             =>'sometimes|numeric|min:0|nullable',
            'name_en'              =>'required|string|min:1|Regex:/[a-z]/i|unique:categories,name_en,'.$this->id,
            'description_en'       =>'sometimes|string|min:5|Regex:/[a-z]/i|nullable',
            'name_ar'              =>'required|string|min:1|Regex:/[أ-ي]/|unique:categories,name_ar,'.$this->id,
            'description_ar'       =>'sometimes|string|min:5|Regex:/[أ-ي]/|nullable',
        ];
    }
}
