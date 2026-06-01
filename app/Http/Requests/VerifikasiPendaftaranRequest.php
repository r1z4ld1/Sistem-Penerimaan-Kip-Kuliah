<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifikasiPendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'status' => [
                'required',
                'in:pending,diterima,ditolak'
            ],

            'catatan_pendaftaran' => [
                'required_if:status,ditolak',
                'nullable',
                'string'
            ]
        ];
    }
    public function messages(): array
    {
        return [

            'catatan_pendaftaran.required_if' =>
            'Catatan wajib diisi jika pendaftaran ditolak.'

        ];
    }
}
