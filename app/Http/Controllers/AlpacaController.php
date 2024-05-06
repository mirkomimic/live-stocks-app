<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageApi\CoreStock;
use Illuminate\Http\Request;
use Inertia\Inertia;
use WebSocket\Client;
use WebSocket\Middleware\CloseHandler;
use WebSocket\Middleware\PingResponder;

class AlpacaController extends Controller
{
  public function __construct(
    public CoreStock $coreStock
  ) {
  }

  public function index(Request $request)
  {
    $intradayProps = $this->coreStock->getIntraday($request);

    return Inertia::render('Alpaca/Index', [
      'intradayProps' => $intradayProps,
      'filters' => $request->toArray(),
    ]);
  }
}
