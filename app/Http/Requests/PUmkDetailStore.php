<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PUmkDetailStore extends FormRequest
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
            'no_urut' => 'required',
            'keterangan_detail' => 'required',
            'account_detail' => 'required',
            'kode_bagian_detail' => 'required',
            'perintah_kerja_detail' => 'required',
            'jenis_biaya_detail' => 'required',
            'c_judex_detail' => 'required',
            'jumlah_detail' => 'required',
        ];
    }
}
