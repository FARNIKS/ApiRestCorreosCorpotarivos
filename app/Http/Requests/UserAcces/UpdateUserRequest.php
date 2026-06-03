<?php

namespace App\Http\Requests\UserAcces;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $userRoute = $this->route('user');
        $userId = is_object($userRoute) ? $userRoute->id : $userRoute;

        return [
            'name'     => 'sometimes|string|max:255',
            'email'    => ['sometimes', 'email', Rule::unique('users')->ignore($userId)],
            'alias'    => ['sometimes', 'string', Rule::unique('users', 'alias')->ignore($userId)],
            'role'     => 'sometimes|in:admin,user',
        ];
    }

    public function messages(): array
    {
        return [
            'alias.unique' => 'Este alias ya está en uso por otro colaborador.',
            'email.unique' => 'El correo ya pertenece a otro usuario.',
            'role.in'      => 'El rol seleccionado no es válido.',
        ];
    }
}
