<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UniversitasUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('universitas')->id;

        return [
            'nama_universitas' => 'required|unique:universitas,nama_universitas,' . $id,
            'alamat' => 'nullable',
        ];
    }
}
