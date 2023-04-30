<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestProductById;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

/**
 * Example for https://store.playstation.com/en-us/product/UP0001-CUSA09311_00-GAME000000000000
 */
$result = $client->get(new RequestProductById('UP0001-CUSA09311_00-GAME000000000000'));

echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
