<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KodeBagianUpdate extends FormRequest
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
            'kode' => "required|alpha_num|size:5|unique:App\Models\KodeBagian,kode,{$this->kode_bagian->kode},kode",
            'nama' => "required|unique:App\Models\KodeBagian,nama,{$this->kode_bagian->nama},nama",
        ];
    }
}
