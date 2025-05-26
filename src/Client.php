<?php

declare(strict_types=1);

namespace PlaystationStoreApi;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Exception\ResponseException;
use PlaystationStoreApi\Request\BaseRequest;
use Psr\Http\Message\ResponseInterface;
use Throwable;

final class Client
{
    public const HEADER_CONTENT_TYPE = 'application/json';

    public readonly RequestLocatorService $requestServiceLocator;

    public function __construct(
        private readonly RegionEnum $regionEnum,
        private readonly ClientInterface $client,
        ?RequestLocatorService $requestServiceLocator = null
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
     * @param array<string, string> $cookies
     */
    public function getResponse(BaseRequest $request, array $cookies = []): ResponseInterface
    {
        try {
            $info = $this->requestServiceLocator->get($request::class);

            $jar = CookieJar::fromArray($cookies, 'playstation.com');

            return $this->client->request(
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
                    'headers' => [
                        'x-psn-store-locale-override' => $this->regionEnum->value,
                        'content-type' => self::HEADER_CONTENT_TYPE,
                    ],
                    'cookies' => $jar,
                ]
            );

        } catch (Exception|GuzzleException $e) {
            return $this->tryWithCookie($request, $cookies, $e);
        }
    }

    /**
     * @param array<string, string> $cookies
     * @throws ResponseException
     */
    private function tryWithCookie(BaseRequest $request, array $cookies, Throwable $exception): ResponseInterface
    {
        if (count($cookies) === 0 && $exception instanceof BadResponseException) {
            $cookies = [];

            foreach ($exception->getResponse()->getHeader('Set-Cookie') as $value) {
                [$item,]                    = explode(';', $value, 2);
                [$cookieName, $cookieValue] = explode('=', $item, 2);

                $cookies[$cookieName] = $cookieValue;
            }

            return $this->getResponse($request, $cookies);
        }

        throw new ResponseException(
            $request,
            'An error occurred while trying to request',
            (int) $exception->getCode(),
            $exception
        );
    }
}
