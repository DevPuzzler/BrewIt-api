<?php

namespace App\Http\Responses;

use App\Interfaces\Responses\JsonResponseInterface;
use InvalidArgumentException;
use App\Interfaces\Responses\{
    ResponseDataVOInterface as ResponseData,
    ResponseErrorVOInterface as ResponseError
};
use App\Tools\ValueObjects\Responses\JsonResponseVO;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

abstract class AbstractJsonResponse extends JsonResponse implements JsonResponseInterface
{
    public const STATUS_CODE_EXCEPTION_PATTERN = 'Status code [%s] is not supported.';

    /** Override in child or end up with error */
    protected $statusCode = null;

    public abstract static function create(
        ?array $data,
        mixed $error,
        array $headers = []
    ): JsonResponseInterface;

    public function __construct(
        private readonly ResponseData $responseData,
        private readonly ResponseError   $responseError,
        array $headers = []
    ) {
        parent::__construct(
            $this->getResponseData()->getResponseDataArray(),
            $this->getValidatedStatusCode(),
            $headers
        );
    }

    protected function getValidatedStatusCode(): int
    {
        if ( !in_array( $this->statusCode, array_keys( self::$statusTexts ) ) ) {
            throw new InvalidArgumentException(
                sprintf( self::STATUS_CODE_EXCEPTION_PATTERN, $this->statusCode )
            );
        }

        return $this->statusCode;
    }

    public function getResponseData(): JsonResponseVO
    {
        return new JsonResponseVO (
            $this->responseData,
            $this->responseError,
            $this->isSuccessResponse()
        );
    }

    protected function isSuccessResponse(): bool
    {
        return
            $this->getStatusCode() >= Response::HTTP_OK &&
            $this->getStatusCode() < Response::HTTP_MULTIPLE_CHOICES;
    }

}
