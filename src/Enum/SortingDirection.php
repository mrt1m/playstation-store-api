<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

use MyCLabs\Enum\Enum;

class SortingDirection extends Enum
{
    public const ASC = true;
    public const DESC = false;
}