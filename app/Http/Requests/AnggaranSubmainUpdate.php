<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggaranSubmainUpdate extends FormRequest
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
            'kode_main'  => 'required|alpha_num|max:6',
            'kode'       => 'required|alpha_num|min:2|max:6',
            'nama'       => 'required',
            'tahun'      => 'required|numeric',
            'nilai'      => 'required|numeric',
            // 'nilai_real' => 'required|numeric',
        ];
    }
}
