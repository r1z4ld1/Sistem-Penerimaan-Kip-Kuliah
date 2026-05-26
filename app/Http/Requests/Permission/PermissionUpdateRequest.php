<?php

namespace App\Http\Requests\Permission;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $permissionId =
            $this->route('permission')->id;

        return [

            'name' =>
            'required|string|unique:permissions,name,' . $permissionId

        ];
    }
}
