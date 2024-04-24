<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageApi\FundamentalData\FundamentalData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FundamentalDataController extends Controller
{
  public function __construct(
    protected FundamentalData $fundamentalData,
  ) {
  }

  public function earnings(Request $request)
  {
    $earnings = $this->fundamentalData->earnings($request);

    return Inertia::render('Data/Earnings', [
      'earnings' => $earnings,
      'filters' => $request->toArray()
    ]);
  }
}
