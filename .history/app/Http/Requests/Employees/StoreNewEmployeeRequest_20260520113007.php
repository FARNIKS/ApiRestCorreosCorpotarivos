<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewEmployeeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta petición.
     */
    public function authorize(): bool
    {
        return true; // Cambiado a true para permitir el acceso a la API
    }

    /**
     * Reglas de validación para la creación del nuevo empleado.
     */
    public function rules(): array
    {
        return [
            'nombre'       => 'required|string|max:255',
            // Validamos que el departamento exista en la tabla relacionada si es necesario, 
            // de lo contrario lo dejamos como string requerido
            'departamento' => 'required|string|max:255',
            // Validamos que la empresa_code exista en la columna 'code' de la tabla 'branches'
            'empresa_code' => 'required|string|exists:branches,code',
            'enviado'      => 'nullable|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados (Opcional, pero ideal para tu API).
     */
    public function messages(): array
    {
        return [
            'nombre.required'       => 'El nombre del empleado es obligatorio.',
            'departamento.required' => 'El departamento es obligatorio.',
            'empresa_code.required' => 'El código de la empresa es obligatorio.',
            'empresa_code.exists'   => 'El código de la empresa seleccionado no es válido.',
            'enviado.boolean'       => 'El campo enviado debe ser verdadero o falso.',
        ];
    }
}
