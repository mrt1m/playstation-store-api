<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Request;

final class RequestPricingDataByConceptId implements BaseRequest
{
    public function __construct(public readonly string $conceptId)
    {
    }
}
