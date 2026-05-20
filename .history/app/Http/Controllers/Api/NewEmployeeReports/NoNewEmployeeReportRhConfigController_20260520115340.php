<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NoNewEmployeeReportRhConfig;
use App\Http\Requests\NewEmployeeReports\UpdateNoNewEmployeeReportRhConfigRequest;
use App\Http\Resources\NoNewEmployeeReportRhConfigResource;
use Illuminate\Http\JsonResponse;

class NoNewEmployeeReportRhConfigController extends Controller
{
    public function index(): JsonResponse
    {
        $config = NoNewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        return response()->json([
            'status' => 'success',
            'data'   => new NoNewEmployeeReportRhConfigResource($config)
        ]);
    }

    public function update(UpdateNoNewEmployeeReportRhConfigRequest $request): JsonResponse
    {
        $config = NoNewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Configuración del reporte de RH (Sin Novedades) actualizada',
            'data'    => new NoNewEmployeeReportRhConfigResource($config)
        ]);
    }

    public function restore(): JsonResponse
    {
        $config = NoNewEmployeeReportRhConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($this->getDefaultValues());

        return response()->json([
            'status'  => 'success',
            'message' => 'Plantilla de RH (Sin Novedades) restablecida por defecto',
            'data'    => new NoNewEmployeeReportRhConfigResource($config)
        ]);
    }

    private function getDefaultValues(): array
    {
        return [
            'title'        => 'Gestión de Nuevos Talentos',
            'intro_text'   => "Estimado equipo de Talento Humano:\n\nDe acuerdo con el proceso de control automatizado, se informa que durante el ciclo actual no se han registrado nuevos ingresos de personal en el sistema de OBGROUP.",
            'closing_text' => "Si existen procesos de contratación completados que no se reflejen en este informe, por favor verifique la carga de datos directamente en el portal administrativo para mantener la consistencia de la información.",
            'sign_off'     => 'OBGROUP AUTOMATION SYSTEM'
        ];
    }
}
