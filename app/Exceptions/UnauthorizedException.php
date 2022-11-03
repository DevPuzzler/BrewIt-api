<?php

namespace App\Exceptions;

use Spatie\Permission\Exceptions\UnauthorizedException as SpatieUnauthorizedException;

class UnauthorizedException extends SpatieUnauthorizedException
{
    public const SINGLE_ROLE_EXCEPTION_MESSAGE = 'User does not have required access.';

    public static function forWrongRole(): self
    {
        return new static(
            403,
            self::SINGLE_ROLE_EXCEPTION_MESSAGE,
            null,
            []
        );
    }
}
