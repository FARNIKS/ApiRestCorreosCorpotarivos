<?php

namespace App\Http\Requests\UserAcces;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|max:255',
            'alias'    => 'required|string|unique:users,alias|max:255',
            'role'     => 'required|in:admin,user',
        ];
    }
}
