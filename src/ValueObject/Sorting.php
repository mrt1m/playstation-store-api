<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ValueObject;

use PlaystationStoreApi\Enum\SortingDirection;

class Sorting
{
    protected string $fieldName;
    protected bool $isAscending;

    public function __construct(string $fieldName, SortingDirection $sortingDirection = null)
    {
        $this->fieldName = $fieldName;
        $this->isAscending = (isset($sortingDirection) ? $sortingDirection->getValue() : SortingDirection::DESC) === true;
    }

    public function fieldName() : string
    {
        return $this->fieldName;
    }

    public function isAscending() : bool
    {
        return $this->isAscending;
    }

}