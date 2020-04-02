<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggaranSubmainDetailStore extends FormRequest
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
            'kode_submain' => 'required|alpha_num|size:6',
            'kode' => 'required|alpha_num|size:6',
            'nama' => 'required|alpha_num',
            'tahun' => 'required|numeric',
            'nilai' => 'required|numeric',
        ];
    }
}
