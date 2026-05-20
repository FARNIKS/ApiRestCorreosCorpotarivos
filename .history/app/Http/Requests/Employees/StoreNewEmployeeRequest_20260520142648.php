<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'nombre'       => 'required|string|max:255',

            // Valida que el departamento exista en la columna 'Departamento' de la tabla 'employees'
            'departamento' => 'required|string|exists:AX_Usuarios_Cumple,Departamento',
            // Valida que el codigo exista en la columna 'code' de la tabla 'branches'
            'empresa_code' => 'required|string|exists:branches,code',

            'enviado'      => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'       => 'El nombre del empleado es obligatorio.',
            'departamento.required' => 'El departamento es obligatorio.',
            'departamento.exists'   => 'El departamento seleccionado no es válido o no existe en el sistema.',
            'empresa_code.required' => 'El código de la empresa es obligatorio.',
            'empresa_code.exists'   => 'El código de la empresa seleccionado no es válido o no existe.',
            'enviado.boolean'       => 'El campo enviado debe ser un valor booleano.',
        ];
    }
}
