<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PekerjaStore extends FormRequest
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
            'nomor'               => "required|alpha_num|size:6|unique:App\Models\Pekerja,nopeg",
            'nama'                => "required|string",
            'status'              => "required",
            'tanggal_lahir'       => "required|date_format:Y-m-d|before:today",
            'tempat_lahir'        => "required",
            'provinsi'            => "required",
            'agama'               => "required",
            'golongan_darah'      => "required",
            'no_telepon'          => "required|string|digits_between:6,15",
            'kode_keluarga'       => "required|numeric|digits:3",
            'no_ydp'              => "required|numeric",
            'no_astek'            => "required|numeric",
            'tanggal_aktif_dinas' => "required|date_format:Y-m-d",
            'alamat_1'            => "required|different:alamat_2|different:alamat_3",
            'alamat_2'            => "required|different:alamat_1|different:alamat_3",
            'alamat_3'            => "required|different:alamat_1|different:alamat_2",
            'gelar_1'             => "required|different:gelar_2|different:gelar_3",
            'gelar_2'             => "required|different:gelar_1|different:gelar_3",
            'gelar_3'             => "required|different:gelar_1|different:gelar_2",
            'no_handphone'        => "required|numeric|digits_between:10,15",
            'jenis_kelamin'       => "required",
            'npwp'                => "required|numeric|digits_between:10,20",
            'photo'               => "image",
        ];
    }
}
