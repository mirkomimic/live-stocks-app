<?php

namespace App\Services\AlphaVantageApi\Interfaces;

interface TimeSeries
{
  public function getDaily($request): array;

  public function getIntraday($request): array;
}
