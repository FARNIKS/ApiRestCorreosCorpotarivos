<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Cache;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:send-daily-birthdays')
    ->dailyAt('08:00')
    ->skip(function () {
        return (bool) Cache::get('birthdays_paused', false);
    });

// 2. Reporte para Recursos Humanos (Viernes a las 5:00 PM)
Schedule::command('app:send-friday-hr-report')
    ->fridays()
    ->at('17:00');

// 3. Procesamiento y envío general (Lunes a las 7:00 AM)
Schedule::command('app:process-monday-new-employees')
    ->mondays()
    ->at('07:00');
