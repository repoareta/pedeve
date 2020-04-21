<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpahAllInStore extends FormRequest
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
            'nilai_upah_all_in'  => "required|numeric",
            'mulai_upah_all_in'  => "nullable|date|required_with:sampai_upah_all_in",
            'sampai_upah_all_in' => "nullable|date",
        ];
    }
}
