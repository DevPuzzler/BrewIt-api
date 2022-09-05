<?php

namespace App\Tools\ValueObjects\Responses;

use App\Interfaces\Responses\ResponseDataVOInterface;

class JsonResponseDataVO implements ResponseDataVOInterface
{
    public function __construct(private readonly ?array $responseData = null) {}

    public function getValue(): ?array
    {
        return $this->responseData;
    }
}
