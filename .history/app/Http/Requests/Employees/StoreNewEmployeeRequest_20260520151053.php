<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNewEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:255'],
            'empresa_code' => ['required', 'string', 'exists:branches,code'], // Asumiendo tu tabla local de branches
            'enviado'      => ['nullable', 'boolean'],

            // 🔥 AQUÍ ESTÁ LA VALIDACIÓN EN LA BASE DE DATOS EXTERNA:
            'departamento' => [
                'required',
                'string',
                Rule::exists('sqlsrvax.AX_Usuarios_Cumple', 'Departamento') // Obliga a que exista en SQL Server
            ],
        ];
    }

    /**
     * Opcional: Personaliza el mensaje de error por si alteran el formulario
     */
    public function messages(): array
    {
        return [
            'departamento.exists' => 'El departamento seleccionado no es válido o no existe en el sistema central.',
        ];
    }
}
