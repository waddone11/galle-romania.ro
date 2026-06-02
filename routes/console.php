<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Daily sitemap regeneration so blog / proiecte updates reach search engines.
Schedule::command('sitemap:generate')->dailyAt('03:30');

// Single-tick queue runner under ALL-INKL's per-minute cron — fara supervisor Redis.
Schedule::command('queue:work --stop-when-empty --tries=3 --timeout=120')
    ->everyMinute()
    ->withoutOverlapping();
