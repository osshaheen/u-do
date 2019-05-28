<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateWeekDayRequest extends FormRequest
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
            'day_en'  =>  'required|string|min:2|regex:/[a-z]/i|unique:week_days,day_en,'.$this->id,
            'day_ar'  =>  'required|string|min:2|regex:/[أ-ي]/|unique:week_days,day_ar,'.$this->id,
        ];
    }
}
