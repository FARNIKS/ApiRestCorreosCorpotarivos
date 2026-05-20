<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewEmployeeMailService;
use App\Mail\NewEmployeesReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryEmployee;
use App\Models\NewEmployeeReportConfig; // <--- 1. IMPORTAR EL MODELO DE CONFIGURACIÓN

class ProcessMondayNewEmployee extends Command
{
    /**
     * El nombre debe coincidir con lo que registres en el Kernel o lo que llames por terminal.
     */
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

        // 2. Obtener o crear la configuración de textos y banner de la base de datos
        $config = NewEmployeeReportConfig::firstOrCreate([], [
            'banner_url'   => 'https://www.elorbe.la/images/bienvenida.jpg',
            'intro_text'   => "Estimado equipo de Talento Humano:",
            'main_body'    => "Compartimos el consolidado de las nuevas incorporaciones registradas en la plataforma durante el ciclo actual. Estos perfiles han sido validados exitosamente y quedan programados para la notificación institucional del próximo lunes.",
            'closing_text' => "Estamos seguros de que su talento, experiencia y compromiso serán un gran aporte para continuar alcanzando grandes metas juntos.",
            'sign_off'     => "Departamento de Talento Humano"
        ]);

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
            // 4. Enviar el Mail masivo PASANDO AMBOS PARÁMETROS ($data y $config)
            Mail::to('talentohumanocentroa@corporacionob.com')
                ->bcc($bccList)
                ->send(new NewEmployeesReport($data, $config)); // <--- ¡AQUÍ ESTÁ LA CORRECCIÓN!

            // 5. Mover a Historia y Limpiar la tabla original
            DB::transaction(function () use ($data) {
                foreach ($data['raw_collection'] as $emp) {
                    HistoryEmployee::create([
                        'nombre'       => $emp->nombre,
                        'departamento' => $emp->departamento,
                        'empresa_code' => $emp->empresa_code,
                        'fecha_envio'  => now(),
                    ]);

                    // Borramos de la tabla 'new_employee' para que el ciclo empiece limpio la otra semana
                    $emp->delete();
                }
            });

            $this->info('Proceso de lunes completado con éxito: Correos enviados y datos movidos a historial.');
        } catch (\Exception $e) {
            $this->error('Error durante el proceso: ' . $e->getMessage());
        }
    }
}
