<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KursusStore extends FormRequest
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
            "nama_kursus"          => "required",
            "penyelenggara_kursus" => "required",
            "mulai_kursus"         => "required|date",
            "sampai_kursus"        => "required|date",
            "negara_kursus"        => "required",
            "kota_kursus"          => "required",
            "keterangan_kursus"    => "nullable",
        ];
    }
}
