<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PekerjaPendidikanStore extends FormRequest
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
            "kode_pendidikan_pekerja"    => "required",
            "tempat_didik_pekerja"       => "required",
            "kode_pt_pendidikan_pekerja" => "nullable",
            "mulai_pendidikan_pekerja"   => "required|date",
            "sampai_pendidikan_pekerja"  => "nullable|date",
            "catatan_pendidikan_pekerja" => "nullable",
        ];
    }
}
