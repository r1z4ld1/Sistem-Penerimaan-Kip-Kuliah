<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('user')->id;

        return [

            'name' => 'required|string|max:255',

            'email' =>
            'required|email|unique:users,email,' . $userId,

            'password' => 'nullable|min:6',

            'role' => 'required'

        ];
    }
}
