<?php
declare(strict_types=1);

namespace PlaystationStoreApi;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use PlaystationStoreApi\Enum\RegionEnum;
use PlaystationStoreApi\Exception\ResponseException;
use PlaystationStoreApi\Request\BaseRequest;
use Psr\Http\Message\ResponseInterface;

final class Client
{
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
                        'x-psn-store-locale-override' => $this->regionEnum->value
                    ],
                ]
            );

        } catch (Exception|GuzzleException $e) {

            var_dump($e->getMessage());

            exit();
            throw new ResponseException(
                $request,
                'An error occurred while trying to request',
                $e->getCode(),
                $e
            );
        }
    }
}
