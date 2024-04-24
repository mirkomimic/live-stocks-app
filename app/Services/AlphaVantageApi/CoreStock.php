<?php

namespace App\Services\AlphaVantageApi;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class CoreStock extends AlphaVantage
{
  private array $response = [];

  public function __construct()
  {
    parent::__construct();
  }

  public function getDaily($request): array
  {

    if ($request->month) {
      $month = date_parse($request->month);
      $month = $month['month'];
    }

    // try {
    //   $data = Http::get($this->endpoint, [
    //     'function' => 'TIME_SERIES_DAILY',
    //     'symbol' => $request->symbol ?? 'IBM',
    //     'outputsize' => 'compact',
    //     'apikey' => $this->apiKey,
    //   ])->json();
    // } catch (RequestException $ex) {
    //   echo 'Caught exception: ',  $ex->getMessage(), "\n";
    // }

    $data = json_decode(json: file_get_contents(base_path('jsonData/stocks.json')), associative: true);

    if (!isset($data['Time Series (Daily)'])) return [];

    foreach ($data['Time Series (Daily)'] as $key => $object) {

      $monthNum = getdate(strtotime($key))['mon'];
      $yearNum = getdate(strtotime($key))['year'];

      $monthData = $request->month !== null ? $month : (int) date('m');
      $yearData = $request->year !== null ? (int) $request->year : (int) date('Y');

      if ($yearData == $yearNum) {
        if ($monthData == $monthNum) {
          $this->response['labels'][] = $key;
          $this->response['datasets'][] = [
            'high' => $object['2. high'],
            'low' => $object['3. low']
          ];
        }
      }
    }

    return $this->response;
  }

  public function getIntraday($request): array
  {
    return $this->response;
  }
}
