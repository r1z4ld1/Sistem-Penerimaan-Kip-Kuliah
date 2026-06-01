<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaUpdateRequest extends FormRequest
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
        $mahasiswa = $this->route('mahasiswa');

        return [
            'nama' => 'required',

            'nik' => [
                'required',
                'digits:16',
                Rule::unique('mahasiswa', 'nik')
                    ->ignore($mahasiswa->id),
            ],

            'nisn' => [
                'required',
                Rule::unique('mahasiswa', 'nisn')
                    ->ignore($mahasiswa->id),
            ],

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
