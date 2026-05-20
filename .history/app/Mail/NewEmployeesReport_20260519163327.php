<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\NewEmployeeReportConfig; // <--- Él se encarga de su modelo

class NewEmployeesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $config;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->config = NewEmployeeReportConfig::first() ?? new NewEmployeeReportConfig([
            'banner_url'   => 'https://www.elorbe.la/images/bienvenida.jpg',
            'intro_text'   => "Estimado equipo de Talento Humano:",
            'main_body'    => "Compartimos el consolidado de las nuevas incorporaciones registradas en la plataforma.",
            'closing_text' => "Estamos seguros de que su talento, experiencia y compromiso serán un gran aporte.",
            'sign_off'     => "Departamento de Talento Humano"
        ]);
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
