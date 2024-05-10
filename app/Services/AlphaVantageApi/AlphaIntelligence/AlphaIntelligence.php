<?php

namespace App\Services\AlphaVantageApi\AlphaIntelligence;

use App\Services\AlphaVantageApi\AlphaVantage;

class AlphaIntelligence extends AlphaVantage
{

  private array $response = [];

  public function getTopGainersAndLosers(): array
  {
    // try {
    //   $data = Http::get($this->endpoint, [
    //     'function' => 'TOP_GAINERS_LOSERS',
    //     'apikey' => $this->apiKey,
    //   ])->json();
    // } catch (RequestException $ex) {
    //   echo 'Caught exception: ',  $ex->getMessage(), "\n";
    // }

    $data = json_decode(json: file_get_contents(base_path('jsonData/topGainersAndLosers.json')), associative: true);

    if (!isset($data)) return [];

    $this->response['top_gainers'] = array_slice($data['top_gainers'], 0, 5);
    $this->response['top_losers'] = array_slice($data['top_losers'], 0, 5);
    $this->response['most_actively_traded'] = array_slice($data['most_actively_traded'], 0, 5);

    return $this->response;
  }
}
