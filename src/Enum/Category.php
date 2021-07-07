<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

use MyCLabs\Enum\Enum;

class Category extends Enum
{
    public const PS4_GAMES = '44d8bb20-653e-431e-8ad0-c0a365f68d2f';
    public const PS5_GAMES = '4cbf39e2-5749-4970-ba81-93a489e4570c';
    public const PS_PLUS = '038b4df3-bb4c-48f8-8290-3feb35f0f0fd';
    public const SALES = '803cee19-e5a1-4d59-a463-0b6b2701bf7c';
    public const EA_GAMES = '74d4e266-5c64-4c61-a7e3-1b6e78f643e6';
}