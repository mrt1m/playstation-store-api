<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ApiClients;

use GuzzleHttp\Psr7\Uri;
use PlaystationStoreApi\Enum\Region;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

final class GraphQL extends BaseApiClient
{

    public function __construct(Region $region, ClientInterface $client)
    {
        parent::__construct($region, $client);

        $this->basePath = new Uri('https://web.np.playstation.com/api/graphql/v1/');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function get(RequestInterface $request): string
    {
        $response = $this->client->sendRequest(
            $request
                ->withUri($this->mergeBasePath($request->getUri()))
                ->withAddedHeader('x-psn-store-locale-override', $this->language . '-' . strtoupper($this->region))
        );

        return $response->getBody()->getContents();
    }
}
