<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Exception;

use Exception;
use PlaystationStoreApi\Request\BaseRequest;
use Throwable;

class ResponseException extends Exception
{
    public function __construct(
        public readonly BaseRequest $baseRequest,
        string $message,
        int $code,
        Throwable $previous
    ) {
        parent::__construct($message, $code, $previous);
    }
}
