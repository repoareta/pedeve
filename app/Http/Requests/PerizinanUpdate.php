<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerizinanUpdate extends FormRequest
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
            'keterangan_perizinan' => 'required',
            'nomor_perizinan' => 'required',
            'masa_berlaku_akhir_perizinan' => 'required|date',
            'dokumen_perizinan' => 'mimes:pdf',
        ];
    }
}