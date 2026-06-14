<?php

declare(strict_types=1);

namespace PlaystationStoreApi\ValueObject;

final class Pagination
{
    public function __construct(public readonly int $size, public readonly int $offset = 0)
    {
    }
}
