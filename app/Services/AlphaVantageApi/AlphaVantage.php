<?php

namespace App\Services\AlphaVantageApi;

abstract class AlphaVantage
{
  protected readonly string $apiKey;
  protected readonly string $endpoint;

  public function __construct()
  {
    $this->apiKey = env('ALPHAVANTAGE_KEY');
    $this->endpoint = 'https://www.alphavantage.co/query';
  }
}
