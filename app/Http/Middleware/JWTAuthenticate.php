<?php

namespace App\Http\Middleware;

use App\Http\Responses\JSON\DefaultErrorResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\{TokenInvalidException, TokenExpiredException};
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTAuthenticate extends BaseMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // TODO: decide on how to assign roles
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {

            return DefaultErrorResponse::create(
                null,
                match(true) {
                    $e instanceof TokenInvalidException => 'Token invalid.',
                    $e instanceof TokenExpiredException => 'Token expired.',
                    default => 'Token not found.'
                },
                [],
                Response::HTTP_UNAUTHORIZED,
            );
        }

        $request->attributes->add([
            'user' => $user
        ]);

        return $next($request);
    }
}
