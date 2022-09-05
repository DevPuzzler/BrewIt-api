<?php

namespace App\Tools\ValueObjects\Responses;

use App\Interfaces\Responses\ResponseErrorVOInterface;

class JsonResponseErrorVO implements ResponseErrorVOInterface
{
    public function __construct(private readonly mixed $responseError = null) {}

    public function getValue(): mixed
    {
        return $this->responseError;
    }
}
