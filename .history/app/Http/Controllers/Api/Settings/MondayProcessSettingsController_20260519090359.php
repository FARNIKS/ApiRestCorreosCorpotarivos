<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MondayProcessSettingsController extends Controller
{
    private $cacheKey = 'new_employees_monday_paused';
    private $command = 'app:process-monday-new-employees';

    /**
     * Obtiene el estado del proceso del lunes.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'service' => 'Proceso de Lunes (General Corporativo)',
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
            'message' => $newStatus ? 'Proceso del lunes pausado' : 'Proceso del lunes reanudado',
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
                    'message' => 'El proceso general de los lunes se ejecutó correctamente.'
                ]);
            }

            return response()->json([
                'status' => 'warning',
                'message' => 'El comando terminó con código de salida: ' . $exitCode
            ], 207);
        } catch (\Exception $e) {
            Log::error("Error en ejecución manual de proceso lunes: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Fallo al ejecutar el proceso: ' . $e->getMessage()
            ], 500);
        }
    }
}
