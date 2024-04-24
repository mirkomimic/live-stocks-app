<?php

use App\Events\CryptoIntradayEvent;
use App\Services\AlphaVantageApi\Cryptocurrencies;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
  $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {

  // $message = Cache::get('message');
  $cryptoService = new Cryptocurrencies();
  $data = $cryptoService->getIntraday([]);

  CryptoIntradayEvent::dispatch($data);
})->everyMinute();
