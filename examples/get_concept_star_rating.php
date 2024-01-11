<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestConceptStarRating;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

/**
 * Example for https://store.playstation.com/en-us/concept/10002694
 */
$result = $client->get(new RequestConceptStarRating('10002694'));

echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);