<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinsiUpdate extends FormRequest
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
            'kode' => "required|numeric|digits:2|unique:App\Models\Provinsi,kode,{$this->provinsi->kode},kode",
            'nama' => "required|unique:App\Models\Provinsi,nama,{$this->provinsi->nama},nama",
        ];
    }
}
