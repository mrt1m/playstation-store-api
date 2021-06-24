<?php
declare(strict_types=1);

namespace PlaystationStoreApi;

use PlaystationStoreApi\Actions\Product;
use PlaystationStoreApi\Enum\Regions;

class Client
{
    protected Regions $region;
    protected Request $request;

    public function __construct(Regions $region) {

        $this->request = new Request($region);
    }

    public function product() : Product
    {
        return new Product($this->request);
    }
}