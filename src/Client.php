<?php

declare(strict_types=1);

namespace PlaystationStoreApi;

use GuzzleHttp\Psr7\Request as Psr7Request;
use JsonException;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Exception\ResponseException;
use PlaystationStoreApi\Request\BaseRequest;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

final class Client
{
    public const HEADER_CONTENT_TYPE = 'application/json';

    public readonly RequestLocatorService $requestServiceLocator;

    public function __construct(
        private readonly RegionEnum $regionEnum,
        private readonly ClientInterface $client,
        RequestLocatorService $requestServiceLocator = null
    ) {
        $this->requestServiceLocator = $requestServiceLocator ?? RequestLocatorService::default();
    }

    /**
     * @throws ResponseException
     */
    public function get(BaseRequest $request): mixed
    {
        try {

            return json_decode(
                $this->getResponse($request)->getBody()->getContents(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

        } catch (JsonException $e) {
            throw new ResponseException(
                $request,
                'An error occurred while trying to decode response',
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @throws ResponseException
     */
    public function getResponse(BaseRequest $request): ResponseInterface
    {
        try {
            $info = $this->requestServiceLocator->get($request::class);

            return $this->client->sendRequest(
                new Psr7Request(
                    'GET',
                    'op?' . http_build_query(
                        [
                            'operationName' => $info->name,
                            'variables' => json_encode($request, JSON_THROW_ON_ERROR),
                            'extensions' => json_encode(
                                [
                                    'persistedQuery' => [
                                        'version' => 1,
                                        'sha256Hash' => $info->value,
                                    ],
                                ],
                                JSON_THROW_ON_ERROR
                            ),
                        ]
                    ),
                    [
                        'x-psn-store-locale-override' => $this->regionEnum->value,
                        'content-type' => self::HEADER_CONTENT_TYPE,
                    ]
                )
            );

        } catch (Throwable $e) {
            throw new ResponseException(
                $request,
                'An error occurred while trying to request',
                $e->getCode(),
                $e
            );
        }
    }
}
