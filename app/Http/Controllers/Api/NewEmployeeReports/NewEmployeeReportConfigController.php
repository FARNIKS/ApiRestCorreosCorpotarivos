<?php

namespace App\Http\Controllers\Api\NewEmployeeReports;

use App\Http\Controllers\Controller;
use App\Models\NewEmployeeReportConfig;
use App\Http\Requests\NewEmployeeReports\UpdateNewEmployeeReportConfigRequest;
use App\Http\Resources\NewEmployees\NewEmployeeReportConfigResource;
use Illuminate\Http\JsonResponse;

class NewEmployeeReportConfigController extends Controller
{
    public function index(): JsonResponse
    {
        $config = NewEmployeeReportConfig::firstOrCreate([], $this->getDefaultValues());
        return response()->json([
            'status' => 'success',
            'data'   => new NewEmployeeReportConfigResource($config)
        ]);
    }

    public function update(UpdateNewEmployeeReportConfigRequest $request): JsonResponse
    {
        $config = NewEmployeeReportConfig::firstOrCreate([], $this->getDefaultValues());
        $config->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Configuración del reporte de ingresos actualizada con éxito.',
            'data'    => new NewEmployeeReportConfigResource($config)
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
            'intro_text'   => "Estimados colaboradores:",
            'main_body'    => "Es un verdadero gusto presentarles a los nuevos integrantes que se unen a nuestra familia organizacional a partir de esta semana. Los invitamos a brindarles nuestro apoyo y una calurosa bienvenida en el inicio de sus funciones.",
            'closing_text' => "Estamos seguros de que su talento, experiencia y compromiso serán un gran aporte para continuar alcanzando grandes metas juntos.",
            'sign_off'     => "Departamento de Talento Humano"
        ];
    }
}
