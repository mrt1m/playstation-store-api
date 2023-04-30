<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Request;

use PlaystationStoreApi\ValueObject\Pagination;

final class RequestAddOnsByTitleId implements BaseRequest
{
    public readonly Pagination $pageArgs;

    public function __construct(
        public readonly string $npTitleId,
        Pagination $pageArgs = null
    )
    {
        $this->pageArgs = $pageArgs ?? new Pagination(20);
    }
}

