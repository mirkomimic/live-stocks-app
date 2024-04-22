<?php

namespace App\Services\FinazonApi;

class FinazonApi
{
  protected string $apiKey = '';

  public function __construct()
  {
    $this->apiKey = env('FINAZON_KEY');
  }
}
