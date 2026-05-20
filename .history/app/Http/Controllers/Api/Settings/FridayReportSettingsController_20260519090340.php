<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FridayReportSettingsController extends Controller
{
    private $cacheKey = 'new_employees_friday_paused';
    private $command = 'app:send-friday-hr-report';

    /**
     * Obtiene el estado del reporte del viernes.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'service' => 'Reporte de Viernes (RRHH)',
            'is_paused' => (bool) Cache::get($this->cacheKey, false)
        ]);
    }

    /**
     * Alterna el estado de pausa/activación.
     */
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

    /**
     * Ejecución manual instantánea.
     */
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
