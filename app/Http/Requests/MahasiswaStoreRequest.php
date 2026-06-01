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

            //'user_id' => 'required|exists:users,id',
            'nama' => 'required',
            'nik' => 'required|digits:16|unique:mahasiswa,nik,' . $this->mahasiswa,
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
    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
        ];
    }
}
