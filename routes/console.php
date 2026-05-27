<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Cache;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:send-daily-birthdays')
    ->dailyAt('07:00')
    ->skip(function () {
        return (bool) Cache::get('birthdays_paused', false);
    });

Schedule::command('app:send-friday-hr-report')
    ->fridays()
    ->at('17:00')
    ->skip(function () {
        return (bool) Cache::get('new_employees_friday_paused', false);
    });

Schedule::command('app:process-monday-new-employees')
    ->mondays()
    ->at('07:00')
    ->skip(function () {
        return (bool) Cache::get('new_employees_monday_paused', false);
    });
