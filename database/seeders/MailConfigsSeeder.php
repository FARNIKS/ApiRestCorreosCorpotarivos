<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BirthdayConfig;
use App\Models\NoBirthdayConfig;
use App\Models\NewEmployeeReportConfig;
use App\Models\NewEmployeeReportRhConfig;
use App\Models\NoNewEmployeeReportRhConfig;

class MailConfigsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Configuración: Con Cumpleaños (BirthdayConfig)
        BirthdayConfig::firstOrCreate([], [
            'banner_url'   => 'https://www.elorbe.la/images/cumpleanos.jpg',
            'intro_text'   => "¡Feliz Cumpleaños de parte de OBGROUP!\nHoy celebramos el cumpleaños de esos valiosos compañeros que, con su talento y dedicación, hacen crecer a nuestro equipo día a día. ¡Feliz día!",
            'main_body'    => "Les deseamos un día lleno de alegría. ¡Que lo disfruten!",
            'closing_text' => "¡Detente un momento para leer esto...!",
            'sign_off'     => "Departamento de Talento Humano"
        ]);

        // 2. Configuración: Sin Cumpleaños registrados (NoBirthdayConfig)
        NoBirthdayConfig::firstOrCreate([], [
            'intro_text'   => "¡Buen día, equipo de OBGROUP!\n\nHoy no registramos compañeros en cumpleaños en nuestras sucursales, pero aprovechamos este espacio para compartir un mensaje de valor con todos ustedes.",
            'main_body'    => "Inspiración para hoy",
            'closing_text' => "¡Les deseamos una jornada llena de productividad y éxito!",
            'sign_off'     => "Departamento de Talento Humano"
        ]);

        // 3. Configuración: Reporte General de Nuevos Ingresos (NewEmployeeReportConfig)
        NewEmployeeReportConfig::firstOrCreate([], [
            'banner_url'   => 'https://www.elorbe.la/images/bienvenida.jpg',
            'intro_text'   => "Estimados colaboradores:",
            'main_body'    => "Es un verdadero gusto presentarles a los nuevos integrantes que se unen a nuestra familia organizacional a partir de esta semana. Los invitamos a brindarles nuestro apoyo y una calurosa bienvenida en el inicio de sus funciones.",
            'closing_text' => "Estamos seguros de que su talento, experiencia y compromiso serán un gran aporte para continuar alcanzando grandes metas juntos.",
            'sign_off'     => "Departamento de Talento Humano"
        ]);

        // 4. Configuración: Reporte Interno de Recursos Humanos con Novedades (NewEmployeeReportRhConfig)
        NewEmployeeReportRhConfig::firstOrCreate([], [
            'title'        => 'Gestión de Nuevos Talentos',
            'intro_text'   => "Estimado equipo de Talento Humano:\n\nCompartimos el consolidado de las nuevas incorporaciones registradas en la plataforma durante el ciclo actual. Estos perfiles han sido validados exitosamente y quedan programados para la notificación institucional del próximo lunes.",
            'closing_text' => "Si identifica algún proceso de contratación recientemente completado que no se refleje en este listado, le sugerimos verificar el estado del registro en el portal administrativo antes del cierre de la jornada para asegurar la consistencia del onboarding.",
            'sign_off'     => 'OBGROUP AUTOMATION SYSTEM'
        ]);

        // 5. Configuración: Reporte Interno de Recursos Humanos sin Novedades (NoNewEmployeeReportRhConfig)
        NoNewEmployeeReportRhConfig::firstOrCreate([], [
            'title'        => 'Gestión de Nuevos Talentos',
            'intro_text'   => "Estimado equipo de Talento Humano:\n\nDe acuerdo con el proceso de control automatizado, se informa que durante el ciclo actual no se han registrado nuevos ingresos de personal en el sistema de OBGROUP.",
            'closing_text' => "Si existen procesos de contratación completados que no se reflejen en este informe, por favor verifique la carga de datos directamente en el portal administrativo para mantener la consistencia de la información.",
            'sign_off'     => 'OBGROUP AUTOMATION SYSTEM'
        ]);
    }
}
