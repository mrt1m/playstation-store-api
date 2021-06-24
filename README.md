# playstation-store-api

## 1. Prerequisites

* PHP 7.4 or later

## 2. Installation

The VK PHP SDK can be installed using Composer by running the following command:

```sh
composer require mrt1m/playstation-store-api
```

## 3. Initialization

Create Client object using the following code:

```php
use PlaystationStoreApi\Client;
use PlaystationStoreApi\Enum\Regions;

$clientApi = new Client(new Regions(Regions::RUSSIA));
```

## 4. API Requests

### 4.1. Request product data

```php
$response = $clientApi->product()->get('EP0001-CUSA12042_00-GAME000000000000');
```