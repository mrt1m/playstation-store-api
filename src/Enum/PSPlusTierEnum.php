<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

enum PSPlusTierEnum: string
{
    case DELUXE = 'TIER_30';

    case EXTRA = 'TIER_20';

    case ESSENTIAL = 'TIER_10';
}
