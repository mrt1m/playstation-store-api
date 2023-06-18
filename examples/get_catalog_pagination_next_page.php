<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\CategoryEnum;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestProductList;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

$request = RequestProductList::createFromCategory(CategoryEnum::FREE_GAMES);

$result = [];

do {

    $currentPageNumber = $request->pageArgs->offset ? $request->pageArgs->offset / $request->pageArgs->size : 1;
    $result['Result for page number - ' . $currentPageNumber] = $currentPageResult = $client->get($request);
    $totalCount = $currentPageResult['data']['categoryGridRetrieve']['pageInfo']['totalCount'];

} while (($request = $request->createNextPageRequest()) && $request->pageArgs->offset < $totalCount);

echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
