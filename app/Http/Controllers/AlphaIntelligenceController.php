<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageApi\AlphaIntelligence\AlphaIntelligence;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlphaIntelligenceController extends Controller
{
  public function __construct(
    protected AlphaIntelligence $alphaIntelligence,
  ) {
  }

  public function topGainersAndLosers()
  {
    $topGainersAndLosers = $this->alphaIntelligence->getTopGainersAndLosers();

    return Inertia::render('AlphaIntelligence/Index', [
      'topGainersAndLosers' => $topGainersAndLosers
    ]);
  }
}
