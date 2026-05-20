<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewEmployeeReportConfig;
use App\Http\Requests\Employees\UpdateNewEmployeeReportConfigRequest;
use App\Http\Resources\NewEmployeeReportConfigResource;
use Illuminate\Http\JsonResponse;

class NewEmployeeReportConfigController extends Controller
{
    public function index(): JsonResponse
    {
        $config = NewEmployeeReportConfig::firstOrCreate([], $this->getDefaultValues());
        return response()->json([
            'status' => 'success',
            'data'   => new NewEmployeeReportConfigResource($config) // <-- Aplicado aquí
        ]);
    }

    public function update(UpdateNewEmployeeReportConfigRequest $request): JsonResponse
    {
        $config = NewEmployeeReportConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Configuración del reporte de ingresos actualizada con éxito.',
            'data'    => new NewEmployeeReportConfigResource($config) // <-- Aplicado aquí
        ]);
    }

    public function restore(): JsonResponse
    {
        $config = NewEmployeeReportConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($this->getDefaultValues());

        return response()->json([
            'status'  => 'success',
            'message' => 'Plantilla del reporte restablecida por defecto.',
            'data'    => new NewEmployeeReportConfigResource($config)
        ]);
    }

    private function getDefaultValues(): array
    {
        return [
            'banner_url'   => 'https://www.elorbe.la/images/bienvenida.jpg',
            'intro_text'   => "Estimado equipo de Talento Humano:",
            'main_body'    => "Compartimos el consolidado de las nuevas incorporaciones registradas en la plataforma durante el ciclo actual. Estos perfiles han sido validados exitosamente y quedan programados para la notificación institucional del próximo lunes.",
            'closing_text' => "Estamos seguros de que su talento, experiencia y compromiso serán un gran aporte para continuar alcanzando grandes metas juntos.",
            'sign_off'     => "Departamento de Talento Humano"
        ];
    }
}
