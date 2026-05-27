<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\NoNewEmployeeReportRhConfig;

class NoNewEmployeesReportRH extends Mailable
{
    use Queueable, SerializesModels;

    public $config;

    public function __construct()
    {
        $this->config = NoNewEmployeeReportRhConfig::first();
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
