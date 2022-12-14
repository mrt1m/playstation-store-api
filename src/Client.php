<?php
declare(strict_types=1);

namespace PlaystationStoreApi;

use PlaystationStoreApi\Actions\Catalog;
use PlaystationStoreApi\Actions\Product;
use PlaystationStoreApi\ApiClients\Chihiro;
use PlaystationStoreApi\ApiClients\GraphQL;
use PlaystationStoreApi\Enum\Region;
use Psr\Http\Client\ClientInterface;

class Client
{
    protected Chihiro $chihiroApiCLient;

    protected GraphQL $graphQLApiClient;

    public function __construct(Region $region, ClientInterface $client)
    {
        $this->chihiroApiCLient = new Chihiro($region, $client);
        $this->graphQLApiClient = new GraphQL($region, $client);
    }

    public function product(): Product
    {
        return new Product($this->chihiroApiCLient);
    }

    public function catalog(): Catalog
    {
        return new Catalog($this->graphQLApiClient);
    }
}
