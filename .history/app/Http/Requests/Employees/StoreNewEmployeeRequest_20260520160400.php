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

            'departamento' => ['required', 'string', 'max:255'],
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
