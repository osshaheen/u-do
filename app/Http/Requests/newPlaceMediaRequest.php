<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newPlaceMediaRequest extends FormRequest
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
            "files"    => "required|array",
            "files.*"  => "required|mimetypes:video/avi,video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo,video/3gpp,video/MP2T,application/x-mpegURL,image/jpeg,image/png,image/jpg,image/bmp",
            'mediable_id' => 'required|poly_exists:mediable_type',
        ];
    }
}
