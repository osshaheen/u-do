<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newBranchRequest extends FormRequest
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
            'name_en'          =>      'required|string|regex:/[a-z]/i|unique:branches,name_en',
            'name_ar'          =>      'required|string|regex:/[أ-ي]/|unique:branches,name_ar',
            'provider_id'   =>      'required|numeric|exists:providers,id'
        ];
    }
}
