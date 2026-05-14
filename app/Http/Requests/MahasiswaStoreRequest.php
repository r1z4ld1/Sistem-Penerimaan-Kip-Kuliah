<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MahasiswaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',

            'nik' => 'required|unique:mahasiswa,nik',
            'nisn' => 'required|unique:mahasiswa,nisn',

            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',

            'jenis_kelamin' => 'required',

            'alamat' => 'required',

            'no_hp' => 'required',

            'sekolah' => 'required',

            'tahun_lulus' => 'required',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
