<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PlaystationStoreApi\Client;
use PlaystationStoreApi\Enum\Region;
use GuzzleHttp\Client as HttpClient;
use PlaystationStoreApi\Query\CatalogProducts;
use PlaystationStoreApi\Enum\Category;

$clientApi = new Client(new Region(Region::UKRAINE_RUSSIAN), new HttpClient());

$sha256Hash = '4ce7d410a4db2c8b635a48c1dcec375906ff63b19dadd87e073f8fd0c0481d35';
$result = $clientApi->product()->get('EP0001-CUSA12042_00-GAME000000000000');

var_dump($result);