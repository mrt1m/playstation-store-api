<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestAddOnsByTitleId;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

/**
 * You can find value "npTitleId" param in the product or concept response
 */
$result = $client->get(new RequestAddOnsByTitleId('CUSA09311_00'));

echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
