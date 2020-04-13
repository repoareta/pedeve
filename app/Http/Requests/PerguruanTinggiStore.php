<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerguruanTinggiStore extends FormRequest
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
            'kode' => 'required|numeric|digits:4|unique:App\Models\PerguruanTinggi,kode',
            'nama' => 'required|unique:App\Models\PerguruanTinggi,nama',
        ];
    }
}
