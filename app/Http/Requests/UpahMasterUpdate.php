<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpahMasterUpdate extends FormRequest
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
            "bulan"          => "required",
            "tahun"          => "required",
            "pegawai"        => "required",
            "aard"           => "required",
            "jumlah_cicilan" => "required",
            "cicilan"        => "required",
            "nilai"          => "required",
        ];
    }
}
