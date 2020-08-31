<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerusahaanAfiliasiUpdate extends FormRequest
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
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|string|digits_between:6,15',
            'bidang_usaha' => 'required',
            'modal_dasar' => 'required|numeric|min:0',
            'modal_disetor' => 'required|numeric|min:0',
            'jumlah_lembar_saham' => 'required|integer|min:0',
            'nilai_nominal_per_saham' => 'required|numeric|min:0',
        ];
    }
}
