<?php

use App\Services\ProductFeed;
use App\Services\ProductFeedTsv;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Stellt sicher, dass der Merchant-Center-Feed nie länger als die Cache-TTL
// veraltet ist, selbst ohne Produktänderungen (die ProductObserver-Hooks
// invalidieren den Cache zusätzlich bei jeder Änderung).
Schedule::call(function () {
    (new ProductFeed())->forget();
    (new ProductFeedTsv())->forget();
})->daily();
