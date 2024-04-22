<?php

namespace App\Http\Controllers;

use App\Services\FinazonApi\TradesService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TradesController extends Controller
{
  public function __construct(
    protected TradesService $tradesService
  ) {
  }

  public function index()
  {
    // $trades = $this->tradesService->getNews();
    // dd($trades);
    return Inertia::render('Trades/Index', [
      // 'trades' => $trades
    ]);
  }
}
