<?php

namespace Tests\Unit\Http\Responses\JSON;

use App\Http\Responses\JSON\DeleteResponse;
use App\Interfaces\Responses\{
    JsonResponseInterface,
    ResponseDataVOInterface as ResponseDataInterface,
    ResponseErrorVOInterface as ResponseErrorInterface
};

class DeleteResponseTest extends JsonResponseTest
{
    protected function getResponseInstance(
        ?ResponseDataInterface $responseData = null,
        ?ResponseErrorInterface $responseError = null,
        array $headers = []
    ): ?JsonResponseInterface
    {
        return new DeleteResponse($responseData, $responseError, $headers);
    }
}
