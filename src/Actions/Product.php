<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Actions;

use GuzzleHttp\Psr7\Request;
use PlaystationStoreApi\ApiClients\Chihiro;
use Psr\Http\Client\ClientExceptionInterface;

class Product
{
    protected Chihiro $chihiroApiCLient;

    public function __construct(Chihiro $chihiroApiCLient)
    {
        $this->chihiroApiCLient = $chihiroApiCLient;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function get(string $productId) : string
    {
        return $this->chihiroApiCLient->get(new Request('GET', '/' . $productId));
    }
}