<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

enum CatalogSortingEnum: string
{
    case RELEASE_DATE = 'productReleaseDate';

    case BESTSELLERS = 'sales30';

    case TOP_DOWNLOADS = 'downloads30';

    case PRODUCT_NAME = 'productName';

    case PRICE = 'webBasePrice';
}
