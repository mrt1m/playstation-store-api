<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ValueObject;

class Pagination
{
    protected int $size;
    protected int $offset;

    public function __construct(int $size, int $offset = 0)
    {
        $this->size = $size;
        $this->offset = $offset;
    }

    public function size() : int
    {
        return $this->size;
    }

    public function offset() : int
    {
        return $this->offset;
    }
}