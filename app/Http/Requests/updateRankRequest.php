<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRankRequest extends FormRequest
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
            'title_en'  =>  'required|string|min:2|regex:/[a-z]/i|unique:ranks,title_en,'.$this->id,
            'title_ar'  =>  'required|string|min:2|regex:/[أ-ي]/|unique:ranks,title_ar,'.$this->id
        ];
    }
}
