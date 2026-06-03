<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class DevServer extends Command
{
    protected $signature = 'dev:run';

    protected $description = 'Inicia el servidor de desarrollo y el schedule:work simultáneamente';

    public function handle()
    {
        $this->info('Iniciando entorno de desarrollo...');

        $serve = new Process(['php', 'artisan', 'serve']);
        $schedule = new Process(['php', 'artisan', 'schedule:work']);

        $serve->setTimeout(null);
        $schedule->setTimeout(null);

        $serve->start();
        $schedule->start();

        $this->info('-> Servidor PHP Artisan Serve... ¡ACTIVO!');
        $this->info('-> Laravel Scheduler (schedule:work)... ¡ACTIVO!');
        $this->comment('Presiona Ctrl+C para detener ambos procesos.');

        while ($serve->isRunning() && $schedule->isRunning()) {
            echo $serve->getIncrementalOutput();
            echo $schedule->getIncrementalOutput();

            usleep(100000);
        }
    }
}
