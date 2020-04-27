<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KodeJabatanUpdate extends FormRequest
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
            'kode_bagian' => 'required',
            'kode_jabatan' => 'required',
            'nama' => 'required',
            'golongan' => 'required',
            'tunjangan' => 'required',
        ];
    }
}