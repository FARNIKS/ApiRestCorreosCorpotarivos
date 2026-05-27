<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre'       => 'sometimes|string|max:255',
            'departamento' => 'sometimes|string|max:255',
            'empresa_code' => 'sometimes|string|exists:branches,code',
            'enviado'      => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string'        => 'El nombre debe ser una cadena de texto.',
            'departamento.exists'   => 'El departamento especificado no existe en los registros de empleados.',
            'empresa_code.exists'   => 'El código de empresa especificado no existe en las sucursales.',
            'enviado.boolean'       => 'El estado de enviado debe ser verdadero o falso.',
        ];
    }
}
