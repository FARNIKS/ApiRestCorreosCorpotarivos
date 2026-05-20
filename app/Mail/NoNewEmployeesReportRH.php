<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\NoNewEmployeeReportRhConfig; // <--- Él se encarga de su modelo

class NoNewEmployeesReportRH extends Mailable
{
    use Queueable, SerializesModels;

    public $config;

    public function __construct()
    {
        // Se auto-sustenta igual que el de cumpleaños
        $this->config = NoNewEmployeeReportRhConfig::first() ?? new NoNewEmployeeReportRhConfig([
            'title'        => 'Gestión de Nuevos Talentos',
            'intro_text'   => "Estimado equipo de Talento Humano:\n\nDe acuerdo con el proceso de control automatizado, se informa que durante el ciclo actual no se han registrado nuevos ingresos de personal en el sistema de OBGROUP.",
            'closing_text' => "Si existen procesos de contratación completados que no se reflejen en este informe, por favor verifique la carga de datos directamente en el portal administrativo.",
            'sign_off'     => 'OBGROUP AUTOMATION SYSTEM'
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte Semanal - Sin Novedades de Nuevos Ingresos',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.noReportNewEmployesRH',
        );
    }
}
