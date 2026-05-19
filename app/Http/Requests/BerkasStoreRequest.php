<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerkasStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'pendaftaran_id' => 'required|exists:pendaftaran,id',

            'nama_berkas' => 'required',

            'file_berkas' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',

        ];
    }
}
