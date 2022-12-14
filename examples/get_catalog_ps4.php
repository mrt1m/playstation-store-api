<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PlaystationStoreApi\Client;
use PlaystationStoreApi\Enum\Region;
use GuzzleHttp\Client as HttpClient;
use PlaystationStoreApi\Query\CatalogProducts;
use PlaystationStoreApi\Enum\Category;

$clientApi = new Client(new Region(Region::UKRAINE_RUSSIAN), new HttpClient());

$sha256Hash = '<insert-your-sha256Hash>';
$result = $clientApi->catalog()->products(new CatalogProducts(new Category(Category::PS4_GAMES), $sha256Hash));

var_dump($result);