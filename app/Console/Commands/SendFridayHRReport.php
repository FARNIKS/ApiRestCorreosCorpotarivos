<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewEmployeeMailService;
use App\Mail\NewEmployeesReportRH;
use App\Mail\NoNewEmployeesReportRH;
use Illuminate\Support\Facades\Mail;

class SendFridayHRReport extends Command
{
    protected $signature = 'app:send-friday-hr-report';
    protected $description = 'Envía reporte de nuevos ingresos a RRHH (Viernes).';

    public function handle(NewEmployeeMailService $service)
    {
        $data = $service->getProcessedNewEmployees();

        $recipients = [
            'talentohumanocentroa@corporacionob.com',
            'mcabreram@corporacionob.com',
            'ldijeres@corporacionob.com'
        ];

        try {
            if (!$data) {
                Mail::to($recipients)->send(new NoNewEmployeesReportRH());
                $this->info('Sin nuevos registros. Notificación enviada a RH.');
            } else {
                Mail::to($recipients)->send(new NewEmployeesReportRH($data['newEmployees']));
                $this->info('Reporte semanal enviado a RH con los ingresos detectados.');
            }
        } catch (\Exception $e) {
            $this->error('Error al procesar el reporte de viernes: ' . $e->getMessage());
        }
    }
}
