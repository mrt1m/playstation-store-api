<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ApiClients;

use GuzzleHttp\Psr7\Uri;
use PlaystationStoreApi\Enum\Region;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

final class Chihiro extends BaseApiClient
{
    public function __construct(Region $region, ClientInterface $client)
    {
        parent::__construct($region, $client);

        $this->basePath = new Uri(
            'https://store.playstation.com/store/api/chihiro/00_09_000/container/'
            . strtolower($this->region)
            . '/' . strtolower($this->language)
            . '/999/'
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function get(RequestInterface $request): string
    {
        $response = $this->client->sendRequest(
            $request->withUri($this->mergeBasePath($request->getUri()))
        );

        return $response->getBody()->getContents();
    }
}
