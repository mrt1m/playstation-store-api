<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Request;

use PlaystationStoreApi\Enum\PSPlusTierEnum;

final class RequestPSPlusTier implements BaseRequest
{
    public function __construct(public readonly PSPlusTierEnum $tierLabel)
    {
    }
}
