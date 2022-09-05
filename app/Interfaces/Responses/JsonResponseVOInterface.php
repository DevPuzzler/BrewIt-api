<?php

namespace App\Interfaces\Responses;

use App\Interfaces\Responses\{
    ResponseDataVOInterface as ResponseData,
    ResponseErrorVOInterface as ResponseError
};

interface JsonResponseVOInterface
{
    public function getResponseData(): ResponseData;

    public function getResponseError(): ResponseError;

    public function getIsSuccessResponse(): bool;

    public function getResponseDataArray(): array;
}
