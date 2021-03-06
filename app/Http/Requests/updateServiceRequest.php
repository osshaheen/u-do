<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateServiceRequest extends FormRequest
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
//        dd($this);
        return [

            'name_en'=>'required|string|min:2|unique:services,name_en,' . $this->id,
            'description_en'=>'required|string|min:5',
            'name_ar'=>'required|string|min:2|unique:services,name_ar,' . $this->id,
            'description_ar'=>'required|string|min:5',
            'branch_id'=>'required|numeric|exists:branches,id',
            'category_id'=>'required|numeric|exists:categories,id',
        ];
    }
}
