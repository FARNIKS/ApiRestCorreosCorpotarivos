<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewEmployeeReportRhConfig;
use App\Http\Requests\NewEmployeeReports\UpdateNewEmployeeReportRhConfigRequest;
use App\Http\Resources\NewEmployeeReportRhConfigResource;
use Illuminate\Http\JsonResponse;

class NewEmployeeReportRhConfigController extends Controller
{
    public function index(): JsonResponse
    {
        $config = NewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        return response()->json([
            'status' => 'success',
            'data'   => new NewEmployeeReportRhConfigResource($config)
        ]);
    }

    public function update(UpdateNewEmployeeReportRhConfigRequest $request): JsonResponse
    {
        $config = NewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Configuración del reporte interno de RH actualizada',
            'data'    => new NewEmployeeReportRhConfigResource($config)
        ]);
    }

    public function restore(): JsonResponse
    {
        $config = NewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($this->getDefaultValues());

        return response()->json([
            'status'  => 'success',
            'message' => 'Plantilla del reporte de RH restablecida por defecto',
            'data'    => new NewEmployeeReportRhConfigResource($config)
        ]);
    }

    private function getDefaultValues(): array
    {
        return [
            'title'        => 'Gestión de Nuevos Talentos',
            'intro_text'   => "Estimado equipo de Talento Humano:\n\nCompartimos el consolidado de las nuevas incorporaciones registradas en la plataforma durante el ciclo actual. Estos perfiles han sido validados exitosamente y quedan programados para la notificación institucional del próximo lunes.",
            'closing_text' => "Si identifica algún proceso de contratación recientemente completado que no se refleje en este listado, le sugerimos verificar el estado del registro en el portal administrativo antes del cierre de la jornada para asegurar la consistencia del onboarding.",
            'sign_off'     => 'OBGROUP AUTOMATION SYSTEM'
        ];
    }
}
