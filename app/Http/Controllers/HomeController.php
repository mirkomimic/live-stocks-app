<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageApi\CoreStock;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
  public function __construct(
    protected CoreStock $coreStock,
  ) {
  }

  public function index(Request $request)
  {
    $coreStocks = $this->coreStock->getDaily($request);

    return Inertia::render('Home', [
      'coreStocks' => $coreStocks,
      'filters' => $request->toArray()
    ]);
  }
}
