<?php

namespace App\Services\AlphaVantageApi;

use DateTime;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Cryptocurrencies extends AlphaVantage
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
    //     'function' => 'DIGITAL_CURRENCY_DAILY',
    //     'symbol' => $request->symbol ?? 'BTC',
    //     'market' => 'CNY',
    //     'apikey' => $this->apiKey,
    //   ])->json();
    // } catch (RequestException $ex) {
    //   echo 'Caught exception: ',  $ex->getMessage(), "\n";
    // }

    $data = json_decode(json: file_get_contents(base_path('jsonData/crypto.json')), associative: true);

    if (!isset($data['Time Series (Digital Currency Daily)'])) return [];

    foreach ($data['Time Series (Digital Currency Daily)'] as $key => $object) {

      $monthNum = getdate(strtotime($key))['mon'];
      $yearNum = getdate(strtotime($key))['year'];

      $monthData = $request->month !== null ? $month : (int) date('m');
      $yearData = $request->year !== null ? (int) $request->year : (int) date('Y');

      if ($yearData == $yearNum) {
        if ($monthData == $monthNum) {
          $this->response['labels'][] = $key;
          $this->response['datasets'][] = [
            'high' => $object['2b. high (USD)'],
            'low' => $object['3b. low (USD)']
          ];
        }
      }
    }

    return $this->response;
  }

  public function getIntraday($request): array
  {
    // try {
    //   $data = Http::get($this->endpoint, [
    //     'function' => 'CRYPTO_INTRADAY',
    //     'symbol' => $request->symbol ?? 'BTC',
    //     'market' => 'USD',
    //     'interval' => '5min',
    //     'apikey' => $this->apiKey,
    //   ])->json();
    // } catch (RequestException $ex) {
    //   echo 'Caught exception: ',  $ex->getMessage(), "\n";
    // }

    $data = json_decode(json: file_get_contents(base_path('jsonData/cryptoDaily.json')), associative: true);

    if (!isset($data['Time Series Crypto (5min)'])) return [];

    foreach ($data['Time Series Crypto (5min)'] as $key => $object) {
      $key = new DateTime($key);
      $key = $key->format('H:i:s');

      $this->response['labels'][] = $key;
      $this->response['datasets'][] = [
        'high' => $object['2. high'],
        'low' => $object['3. low']
      ];
    }

    return $this->response;
  }
}
