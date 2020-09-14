<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AktaUpdate extends FormRequest
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
            'jenis_akta' => 'required',
            'nomor_akta' => 'required',
            'notaris' => 'required',
            'tanggal_akta' => 'required|date',
            'tmt_berlaku' => 'required|date',
            'tmt_berakhir' => 'date',
            'dokumen_akta' => 'mimes:pdf',
        ];
    }
}
