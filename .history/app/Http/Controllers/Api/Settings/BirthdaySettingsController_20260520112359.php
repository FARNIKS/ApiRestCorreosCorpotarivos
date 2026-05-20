<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BirthdaySettingsController extends Controller
{
    public function index()
    {
        return response()->json([
            'is_paused' => Cache::get('birthdays_paused', false)
        ]);
    }

    public function toggleStatus()
    {
        $isPaused = Cache::get('birthdays_paused', false);
        $newStatus = !$isPaused;

        Cache::forever('birthdays_paused', $newStatus);

        return response()->json([
            'status' => 'success',
            'message' => $newStatus ? 'Envío de correos pausado' : 'Envío de correos reanudado',
            'is_paused' => $newStatus
        ]);
    }

    public function runManualSend()
    {
        try {
            $exitCode = Artisan::call('app:send-daily-birthdays');

            if ($exitCode === 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'El comando se ejecutó correctamente.'
                ]);
            }

            return response()->json([
                'status' => 'warning',
                'message' => 'El comando terminó con un código de salida: ' . $exitCode
            ], 207);
        } catch (\Exception $e) {
            Log::error("Error en envío manual OBGROUP: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Fallo al ejecutar el comando: ' . $e->getMessage()
            ], 500);
        }
    }
}
