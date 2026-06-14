<?php

declare(strict_types=1);

namespace PlaystationStoreApi\ValueObject;

use PlaystationStoreApi\Enum\CatalogSortingEnum;
use PlaystationStoreApi\Enum\SortingDirectionEnum;

final class Sorting
{
    public readonly bool $isAscending;

    public static function createFromCatalogSorting(
        CatalogSortingEnum $catalogSortingEnum,
        SortingDirectionEnum $sortingDirection = SortingDirectionEnum::DESC
    ): Sorting {
        return new self($catalogSortingEnum->value, $sortingDirection);
    }

    public function __construct(
        public readonly string $name,
        SortingDirectionEnum $sortingDirection = SortingDirectionEnum::DESC
    ) {
        $this->isAscending = $sortingDirection === SortingDirectionEnum::ASC;
    }
}
