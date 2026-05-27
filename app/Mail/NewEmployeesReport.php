<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\NewEmployeeReportConfig;

class NewEmployeesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $config;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->config = NewEmployeeReportConfig::first();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Bienvenidos a OBGROUP! - Nuevos Ingresos',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reportNewEmployes',
        );
    }
}
