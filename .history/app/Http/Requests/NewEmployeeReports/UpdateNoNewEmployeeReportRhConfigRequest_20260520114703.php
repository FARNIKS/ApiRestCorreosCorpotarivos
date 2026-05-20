<?php

namespace App\Http\Requests\NewEmployeeReports;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoNewEmployeeReportRhConfigRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta petición.
     */
    public function authorize(): bool
    {
        return true; // Permitimos el paso para la API
    }

    /**
     * Reglas de validación para la plantilla de reporte sin novedades de RH.
     */
    public function rules(): array
    {
        return [
            'title'        => 'sometimes|required|string|max:255',
            'intro_text'   => 'sometimes|required|string|max:2000',
            'closing_text' => 'sometimes|required|string|max:4000',
            'sign_off'     => 'sometimes|required|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados para las respuestas de la API.
     */
    public function messages(): array
    {
        return [
            'title.required'        => 'El título del reporte sin novedades es obligatorio.',
            'title.max'             => 'El título no puede superar los 255 caracteres.',
            'intro_text.required'   => 'El texto introductorio de ausencia de registros es obligatorio.',
            'closing_text.required' => 'El texto de cierre y verificación de datos es obligatorio.',
            'sign_off.required'     => 'La firma institucional de cierre es obligatoria.',
        ];
    }
}
