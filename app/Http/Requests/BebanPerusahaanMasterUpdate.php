<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BebanPerusahaanMasterUpdate extends FormRequest
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
            "tahun"          => "required|numeric|digits:4",
            "pegawai"        => "required",
            "aard"           => "required",
            "last_amount"    => "required",
            "current_amount" => "required",
        ];
    }
}
