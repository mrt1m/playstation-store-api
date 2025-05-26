<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Request;

use PlaystationStoreApi\Enum\CatalogSortingEnum;
use PlaystationStoreApi\Enum\CategoryEnum;
use PlaystationStoreApi\ValueObject\Pagination;
use PlaystationStoreApi\ValueObject\Sorting;

final class RequestProductList implements BaseRequest
{
    public const DEFAULT_PAGINATION_SIZE = 20;

    /** @var array<string, mixed> */
    public array $filterBy = [];

    /** @var array<string, mixed> */
    public array $facetOptions = [];

    public static function createFromCategory(
        CategoryEnum $categoryEnum,
        ?Pagination $pageArgs = null
    ): RequestProductList {
        return new self(
            $categoryEnum->value,
            $pageArgs ?? new Pagination(self::DEFAULT_PAGINATION_SIZE),
            Sorting::createFromCatalogSorting(CatalogSortingEnum::RELEASE_DATE)
        );
    }

    public function __construct(
        public readonly string $id,
        public Pagination $pageArgs,
        public readonly Sorting $sortBy
    ) {
    }

    public function createNextPageRequest(): RequestProductList
    {
        $nextPageRequest           = clone $this;
        $nextPageRequest->pageArgs = new Pagination(
            $this->pageArgs->size,
            $this->pageArgs->offset + $this->pageArgs->size
        );

        return $nextPageRequest;
    }
}
