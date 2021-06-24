<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Actions;

use PlaystationStoreApi\Request;

class Product
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $productId
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $productId) : string
    {
        return $this->request->get($productId);
    }
}