<?php

namespace App\Http\Requests\NewEmployeeReports;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewEmployeeReportRhConfigRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta petición.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    /**
     * Reglas de validación para actualizar la plantilla interna de RH.
     */
    public function rules(): array
    {
        return [
            'title'        => 'sometimes|required|string|max:255',
            'intro_text'   => 'sometimes|required|string|max:2000',
            'closing_text' => 'sometimes|required|string|max:4000', // Un rango amplio para las advertencias de onboarding
            'sign_off'     => 'sometimes|required|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados para las respuestas de la API.
     */
    public function messages(): array
    {
        return [
            'title.required'        => 'El título del reporte es obligatorio.',
            'title.max'             => 'El título no puede superar los 255 caracteres.',
            'intro_text.required'   => 'El texto de introducción no puede quedar vacío.',
            'closing_text.required' => 'El texto de cierre y verificación es obligatorio.',
            'sign_off.required'     => 'La firma del sistema automatizado es obligatoria.',
        ];
    }
}
