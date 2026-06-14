![Logo](https://github.com/mrt1m/playstation-store-api/raw/main/.github/assets/banner.png)

**playstation-store-api** is simple wrapper for working with PlayStation Store API 🎮

Installation
------------

### Prerequisites

* PHP 8.1 or later

The playstation-store-api can be installed using Composer by running the following command:

```sh
composer require mrt1m/playstation-store-api
```

Installation
------------

Create Client object using the following code:

```php
<?php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\CategoryEnum;
use PlaystationStoreApi\Enum\RegionEnum;

require_once __DIR__ . '/../vendor/autoload.php';

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(RegionEnum::UNITED_STATES, new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]));
```

API Requests examples
------------

### Request product data by id

```php
use PlaystationStoreApi\Request\RequestProductById;

/**
 * Example for https://store.playstation.com/en-us/product/UP0001-CUSA09311_00-GAME000000000000
 */
$response = $client->get(new RequestProductById('UP0001-CUSA09311_00-GAME000000000000'));
```

### Request concept data by id

```php
use PlaystationStoreApi\Request\RequestConceptById;

/**
 Example for https://store.playstation.com/en-us/concept/10002694
 */
$response = $client->get(new RequestConceptById('10002694'));
```

### Request catalog data

```php
use PlaystationStoreApi\Request\RequestProductList;

$request = RequestProductList::createFromCategory(CategoryEnum::PS5_GAMES);

$firstPageResponse = $client->get($request);

$nextPageResponse = $client->get($request->createNextPageRequest());
```

Run examples
------------

If you want run [examples](./examples), you need:
1) Docker and docker compose
2) Execute make command for example:
```bash
make get_add_ons_by_title_id
```
3) Get api response from [response](./response) directory

About request signing
------------

For all request you need send sha256Hash. It's request signature.

You can get sha256Hash from browser request:
1) Open the Network panel and find query to https://web.np.playstation.com/api/graphql/v1/op
2) Copy the full request URL and use urldecode
3) sha256Hash is in the extensions parameter, example:

```
https://web.np.playstation.com/api/graphql/v1/op?operationName=categoryGridRetrieve&variables={"id":"44d8bb20-653e-431e-8ad0-c0a365f68d2f","pageArgs":{"size":24,"offset":0},"sortBy":{"name":"productReleaseDate","isAscending":false},"filterBy":[],"facetOptions":[]}&extensions={"persistedQuery":{"version":1,"sha256Hash":"9845afc0dbaab4965f6563fffc703f588c8e76792000e8610843b8d3ee9c4c09"}}
```
If default sha256Hash will be blocked, you can replace the base value:
1) Get new sha256Hash value
2) Replace the default value in ``PlaystationStoreApi\RequestLocatorService``
```php
use PlaystationStoreApi\RequestLocatorService;
use PlaystationStoreApi\Request\RequestPSPlusTier;

$customRequestLocatorService = RequestLocatorService::default();
$customRequestLocatorService->set(RequestPSPlusTier::class, 'new sha256Hash value')
```
3) Give $customRequestLocatorService to client
```php
declare(strict_types=1);

use PlaystationStoreApi\Client;
use GuzzleHttp\Client as HTTPClient;
use PlaystationStoreApi\Enum\CategoryEnum;
use PlaystationStoreApi\Enum\RegionEnum;

const API_URL = 'https://web.np.playstation.com/api/graphql/v1/';

$client = new Client(
    RegionEnum::UNITED_STATES, 
    new HTTPClient(['base_uri' => API_URL, 'timeout' => 5]), 
    $customRequestLocatorService
);
```

Custom request
------------

If you need custom request:
1) Create new request class then implement ``PlaystationStoreApi\Request\BaseRequest``
2) Append new request class with sha256Hash to ``PlaystationStoreApi\RequestLocatorService``
3) Give new RequestLocatorService to client
4) Execute client ``get`` method with new request

