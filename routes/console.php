<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('now', function () {
    $this->info("現在時間是：" . now()->toDateTimeString());
})->purpose('顯示當前系統時間');