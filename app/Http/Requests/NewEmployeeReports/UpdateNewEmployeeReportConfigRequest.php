<?php

namespace App\Http\Requests\NewEmployeeReports;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewEmployeeReportConfigRequest extends FormRequest
{

    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }


    public function rules(): array
    {
        return [
            'banner_url'   => 'sometimes|required|url|max:2048',
            'intro_text'   => 'sometimes|required|string|max:1000',
            'main_body'    => 'sometimes|required|string|max:5000',
            'closing_text' => 'sometimes|required|string|max:2000',
            'sign_off'     => 'sometimes|required|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados para las respuestas JSON de la API.
     */
    public function messages(): array
    {
        return [
            'banner_url.url'       => 'El banner debe ser una URL con un formato válido (ej. http://... o https://...).',
            'banner_url.max'       => 'La URL del banner es demasiado larga.',
            'intro_text.required'  => 'El texto de introducción es obligatorio si se envía en la petición.',
            'main_body.required'   => 'El cuerpo principal del mensaje no puede quedar vacío.',
            'closing_text.required' => 'El texto de cierre es obligatorio.',
            'sign_off.required'    => 'La firma o despedida institucional es obligatoria.',
        ];
    }
}
