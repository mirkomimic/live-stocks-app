<?php

namespace App\Services\AlphaVantageApi\FundamentalData;

use App\Services\AlphaVantageApi\AlphaVantage;
use DateTime;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class FundamentalData extends AlphaVantage
{
  private array $response = [];

  public function earnings($request): array
  {
    // try {
    //   $data = Http::get($this->endpoint, [
    //     'function' => 'EARNINGS',
    //     'symbol' => $request->symbol ?? 'IBM',
    //     'apikey' => $this->apiKey,
    //   ])->json();
    // } catch (RequestException $ex) {
    //   echo 'Caught exception: ',  $ex->getMessage(), "\n";
    // }

    $data = json_decode(json: file_get_contents(base_path('jsonData/earnings.json')), associative: true);

    if (!isset($data)) return [];

    foreach ($data['annualEarnings'] as $object) {
      $year = new DateTime($object['fiscalDateEnding']);
      $year = $year->format('Y');

      $this->response['labels'][] = $year;
      $this->response['datasets'][] = $object['reportedEPS'];
    }

    $this->response['labels'] = array_reverse($this->response['labels']);
    $this->response['datasets'] = array_reverse($this->response['datasets']);

    return $this->response;
  }
}
