<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageApi\Cryptocurrencies;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CryptoController extends Controller
{
  public function __construct(
    protected Cryptocurrencies $cryptoService
  ) {
  }

  public function index(Request $request)
  {
    $crypto = $this->cryptoService->getDaily($request);

    return Inertia::render('Crypto/Index', [
      'crypto' => $crypto,
      'filters' => $request->toArray()
    ]);
  }

  public function intraday(Request $request)
  {
    $crypto = $this->cryptoService->getIntraday($request);

    return Inertia::render('Crypto/Intraday', [
      'crypto' => $crypto,
      'filters' => $request->toArray()
    ]);
  }
}
