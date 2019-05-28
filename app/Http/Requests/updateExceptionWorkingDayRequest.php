<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateExceptionWorkingDayRequest extends FormRequest
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
            'branch_id' =>  'required|numeric|exists:branches,id',
            'day'       =>  'required|date|unique:work_exception_dates,day,branch_id'
        ];
    }
}
