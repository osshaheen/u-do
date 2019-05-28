<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProviderRequest extends FormRequest
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
//        dd($this->name);
        return [
            'name_en'      =>      'required|string|min:5|regex:/[a-z]/i|unique:providers,name_en,'.$this->id,
            'bio_en'       =>      'required|string|min:5|regex:/[a-z]/i',
            'name_ar'      =>      'required|string|min:5|regex:/[أ-ي]/|unique:providers,name_ar,'.$this->id,
            'bio_ar'       =>      'required|string|min:5|regex:/[أ-ي]/',
        ];
    }
}
