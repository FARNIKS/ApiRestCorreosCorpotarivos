<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewEmployeeMailService;
use App\Mail\NewEmployeesReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryEmployee;
use App\Models\NewEmployeeReportConfig;

class ProcessMondayNewEmployee extends Command
{
    protected $signature = 'app:process-monday-new-employees';
    protected $description = 'Envía el correo masivo de nuevos ingresos y los mueve a la tabla de historial.';

    public function handle(NewEmployeeMailService $service)
    {
        // 1. Obtener la data desde el servicio
        $data = $service->getProcessedNewEmployees();

        if (!$data) {
            $this->info('No hay nuevos ingresos pendientes para enviar.');
            return;
        }

        // 2. Obtener la configuración actual de la BD (Si no existe, será null y el Mailable usará sus defaults)
        $config = NewEmployeeReportConfig::first();

        // 3. Definir lista de destinatarios (BCC)
        $bccList = [
            'obarquero@corporacionob.com',
            'orbecostarica@corporacionob.com',
            'orbepanama@corporacionob.com',
            'orbenicaragua@corporacionob.com',
            'orbehonduras@corporacionob.com',
            'orbesalvador@corporacionob.com',
            'orbeguatemala@corporacionob.com',
            'orbecolombia@corporacionob.com',
            'siscon@corporacionob.com',
            'TodoelPersonal@corporacionob.com',
            'TodoElPersonalCR@corporacionob.com',
            'todoelpersonalcentroamerica@corporacionob.com'
        ];

        try {
            // 4. Enviar el Mail masivo pasando la data y la configuración limpia
            Mail::to('talentohumanocentroa@corporacionob.com')
                ->bcc($bccList)
                ->send(new NewEmployeesReport($data, $config));

            // 5. Mover a Historia y Limpiar la tabla original
            DB::transaction(function () use ($data) {
                foreach ($data['raw_collection'] as $emp) {
                    HistoryEmployee::create([
                        'nombre'       => $emp->nombre,
                        'departamento' => $emp->departamento,
                        'empresa_code' => $emp->empresa_code,
                        'fecha_envio'  => now(),
                    ]);

                    // Borramos físico de la tabla temporal de la semana
                    $emp->delete();
                }
            });

            $this->info('Proceso de lunes completado con éxito: Correos enviados y datos movidos a historial.');
        } catch (\Exception $e) {
            $this->error('Error durante el proceso: ' . $e->getMessage());
        }
    }
}
