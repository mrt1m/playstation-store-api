<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Request\RequestConceptByProductId;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));

/**
 * Example for https://store.playstation.com/en-us/product/UP0082-PPSA10664_00-FF16SIEA00000002
 */
$result = $client->get(new RequestConceptByProductId('UP0082-PPSA10664_00-FF16SIEA00000002'));

echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
