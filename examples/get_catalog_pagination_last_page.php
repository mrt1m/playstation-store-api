<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\CategoryEnum;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestProductList;
use PlaystationStoreApi\ValueObject\Pagination;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

$request = RequestProductList::createFromCategory(CategoryEnum::PS5_GAMES);
$firstPageResult = $client->get($request);

$totalCount = $firstPageResult['data']['categoryGridRetrieve']['pageInfo']['totalCount'];
$size = $firstPageResult['data']['categoryGridRetrieve']['pageInfo']['size'];

$request->pageArgs = new Pagination($size, (int)(floor($totalCount / $size) * $size));

$lastPageResult = $client->get($request);

echo json_encode(
    [
        'first page result' => $firstPageResult,
        'last page result' => $lastPageResult,
    ],
    JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
);
