<?php

namespace App\Http\Controllers\Api\Settings;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FridayReportSettingsController extends Controller
{
    private $cacheKey = 'new_employees_friday_paused';
    private $command = 'app:send-friday-hr-report';

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'service' => 'Reporte de Viernes (RRHH)',
            'is_paused' => (bool) Cache::get($this->cacheKey, false)
        ]);
    }

    public function toggleStatus()
    {
        $isPaused = Cache::get($this->cacheKey, false);
        $newStatus = !$isPaused;

        Cache::forever($this->cacheKey, $newStatus);

        return response()->json([
            'status' => 'success',
            'message' => $newStatus ? 'Reporte de viernes pausado' : 'Reporte de viernes reanudado',
            'is_paused' => $newStatus
        ]);
    }

    public function runManual()
    {
        try {
            $exitCode = Artisan::call($this->command);

            if ($exitCode === 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'El reporte de viernes para RRHH se ejecutó correctamente.'
                ]);
            }

            return response()->json([
                'status' => 'warning',
                'message' => 'El comando terminó con código de salida: ' . $exitCode
            ], 207);
        } catch (\Exception $e) {
            Log::error("Error en ejecución manual de reporte viernes: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Fallo al ejecutar el reporte: ' . $e->getMessage()
            ], 500);
        }
    }
}
