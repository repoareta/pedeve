<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GcgPemberianStore extends FormRequest
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
            "tanggal_pemberian"      => "required",
            "bentuk_jenis_pemberian" => "required",
            "nilai"                  => "required",
            "jumlah"                 => "required",
            "penerima_hadiah"        => "required",
            "keterangan"             => "required",
        ];
    }
}