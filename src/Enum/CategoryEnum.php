<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

enum CategoryEnum: string
{
    case PS4_GAMES = '44d8bb20-653e-431e-8ad0-c0a365f68d2f';

    case PS5_GAMES = '4cbf39e2-5749-4970-ba81-93a489e4570c';

    case PS_PLUS = '038b4df3-bb4c-48f8-8290-3feb35f0f0fd';

    case SALES = '803cee19-e5a1-4d59-a463-0b6b2701bf7c';

    case EA_GAMES = '74d4e266-5c64-4c61-a7e3-1b6e78f643e6';

    case EA_PLAY_EARLY_ACCESS = '2ff6eb11-f271-4803-9f79-5b28586f116e';

    case VR = '95239ca7-2dcf-43d9-8d4b-b7672ee9304a';

    case VR2 = '62c2a3b6-41cf-4808-ba48-1e5581eeea35';

    case FREE_GAMES = 'd9930400-c5c7-4a06-a28d-cc74888426dc';

    case NEW_GAMES = 'e1699f77-77e1-43ca-a296-26d08abacb0f';

    case OFFERS = '16b8d09a-d0e3-44e3-96cb-a3b2a21b6d69';

    case ALL_CONCEPTS = '28c9c2b2-cecc-415c-9a08-482a605cb104';
}
