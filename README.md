# playstation-store-api

## 1. Prerequisites

* PHP 7.4 or later

## 2. Installation

The playstation-store-api can be installed using Composer by running the following command:

```sh
composer require mrt1m/playstation-store-api
```

## 3. Initialization

Create Client object using the following code:

```php
use PlaystationStoreApi\Client;
use PlaystationStoreApi\Enum\Region;
use \GuzzleHttp\Client as HttpClient;

$clientApi = new Client(new Region(Region::RUSSIA), new HttpClient());
```

## 4. API Requests

### 4.1. Request product data

```php
$response = $clientApi->product()->get('EP0001-CUSA12042_00-GAME000000000000');
```

### 4.2. Request catalog data

```php
use PlaystationStoreApi\Query\CatalogProducts;
use \PlaystationStoreApi\Enum\Category;
use PlaystationStoreApi\ValueObject\Pagination;

$sha256Hash = 'get your code from request in browser';
$query = new CatalogProducts(new Category(Category::PS4_GAMES), $sha256Hash);
$query->setPagination(new Pagination(10, 0));

$response = $clientApi->catalog()->products($query);
```

#### 4.2.1 Get sha256Hash

1) Open the Network panel and find query to https://web.np.playstation.com/api/graphql/v1/op
2) Copy the full request URL and use urldecode
3) sha256Hash is in the extensions parameter, example:

```
https://web.np.playstation.com/api/graphql/v1//op?operationName=categoryGridRetrieve&variables={"id":"44d8bb20-653e-431e-8ad0-c0a365f68d2f","pageArgs":{"size":24,"offset":0},"sortBy":{"name":"productReleaseDate","isAscending":false},"filterBy":[],"facetOptions":[]}&extensions={"persistedQuery":{"version":1,"sha256Hash":"9845afc0dbaab4965f6563fffc703f588c8e76792000e8610843b8d3ee9c4c09"}}
```
