<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireksiStore extends FormRequest
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
        dd(request('akhir_masa_dinas'));
        return [
            'nama_direksi'  => 'required',
            'tmt_dinas' => 'required|date|before:'.$this->input('akhir_masa_dinas'),
            'akhir_masa_dinas' => 'required|date|after:tmt_dinas',
        ];
    }
}
