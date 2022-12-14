<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ValueObject;

use PlaystationStoreApi\Enum\SortingDirection;

final class Sorting
{
    protected string $fieldName;

    protected SortingDirection $sortingDirection;

    public function __construct(string $fieldName, SortingDirection $sortingDirection = null)
    {
        $this->fieldName = $fieldName;
        $this->sortingDirection = $sortingDirection ?? new SortingDirection(SortingDirection::DESC);
    }

    public function fieldName(): string
    {
        return $this->fieldName;
    }

    public function isAscending(): bool
    {
        return $this->sortingDirection->getValue() === SortingDirection::ASC;
    }

}
