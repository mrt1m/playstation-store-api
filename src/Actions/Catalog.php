<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Actions;

use GuzzleHttp\Psr7\Request;
use PlaystationStoreApi\ApiClients\GraphQL;
use PlaystationStoreApi\Query\CatalogProducts;
use Psr\Http\Client\ClientExceptionInterface;
use JsonException;

final class Catalog
{
    protected GraphQL $graphQLApiClient;

    public function __construct(GraphQL $graphQLApiClient)
    {
        $this->graphQLApiClient = $graphQLApiClient;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function products(CatalogProducts $query) : string
    {
        $params = [
            'operationName' => 'categoryGridRetrieve',
            'variables'     => [
                'id'           => $query->categoryId(),
                'pageArgs'     => [
                    'size'   => $query->pagination()->size(),
                    'offset' => $query->pagination()->offset(),
                ],
                'sortBy'       => [
                    'name'        => $query->sorting()->fieldName(),
                    'isAscending' => $query->sorting()->isAscending(),
                ],
                'filterBy'     => [],
                'facetOptions' => [],
            ],
            'extensions'    => [
                'persistedQuery' => [
                    'version'    => 1,
                    'sha256Hash' => $query->sha256Hash(),
                ],
            ],
        ];

        $params['variables'] = json_encode($params['variables'], JSON_THROW_ON_ERROR);
        $params['extensions'] = json_encode($params['extensions'], JSON_THROW_ON_ERROR);

        return $this->graphQLApiClient->get(new Request('GET', '/op?' . http_build_query($params)));
    }
}
