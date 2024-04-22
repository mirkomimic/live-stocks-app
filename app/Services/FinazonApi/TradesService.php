<?php

namespace App\Services\FinazonApi;

use Finazon\Grpc\Api\DatasetsServiceClient;
use Finazon\Grpc\Api\FindTickersCryptoRequest;
use Finazon\Grpc\Api\GetDatasetsRequest;
use Finazon\Grpc\Api\GetNewsRequest;
use Finazon\Grpc\Api\GetSipTradesRequest;
use Finazon\Grpc\Api\GetTimeSeriesRequest;
use Finazon\Grpc\Exception\RequestException;
use Finazon\Grpc\Service\BenzingaService;
use Finazon\Grpc\Service\DatasetsService;
use Finazon\Grpc\Service\SipService;
use Finazon\Grpc\Service\TickersService;
use Finazon\Grpc\Service\TimeSeriesService;

class TradesService extends FinazonApi
{
  // https://github.com/finazon-io/finazon-grpc-php
  public $service;
  public $request;

  public function __construct()
  {
    // $this->service = new SipService($this->apiKey);
    // $this->request = new GetSipTradesRequest();
    parent::__construct();
  }

  public function getTrades()
  {
    $array = [];

    $service = new TickersService($this->apiKey);
    $request = new FindTickersCryptoRequest();
    $request->setPublisher('binance')
      ->setPageSize(10);

    try {
      $response = $service->findTickersCrypto($request);
      // dd(json_encode($response->getResult()));
      foreach ($response->getResult() as $t) {
        $response = $t->getTicker();
        $array[] = $response;
        // dd($t->getTicker());
        // echo sprintf('%s %s', $t->getTicker(), PHP_EOL,);
      }
      return json_encode($array);
    } catch (RequestException $e) {
      echo sprintf('Received error, code: %s, message: %s%s', $e->getCode(), $e->getMessage(), PHP_EOL);
    }
  }

  // public function getNews()
  // {

  //   $service = new DatasetsServiceClient($this->apiKey, []);
  //   $request = new GetDatasetsRequest();
  //   try {
  //     $response = $service->GetDatasets($request);
  //     dd($response);
  //     foreach ($response->getName() as $t) {
  //       $response = $t->getTicker();
  //       $array[] = $response;
  //       // dd($t->getTicker());
  //       // echo sprintf('%s %s', $t->getTicker(), PHP_EOL,);
  //     }
  //     return json_encode($array);
  //   } catch (RequestException $e) {
  //     echo sprintf('Received error, code: %s, message: %s%s', $e->getCode(), $e->getMessage(), PHP_EOL);
  //   }
  // }
}
