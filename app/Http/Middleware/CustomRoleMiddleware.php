<?php

namespace App\Http\Middleware;

use App\Enums\UserRolesEnum;
use App\Exceptions\UnauthorizedException;
use App\Http\Responses\JSON\DefaultErrorResponse;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middlewares\RoleMiddleware;

class CustomRoleMiddleware extends RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        $authGuard = Auth::guard($guard);

        $isUserRoleEnough = UserRolesEnum::isUserRoleHigherOrEqualPriority(
            UserRolesEnum::tryFrom($authGuard->user()->getRoleNames()[0]),
            UserRolesEnum::tryFrom($role)
        );

        // TODO: add check if role is higher priority
        if ( !$isUserRoleEnough ) {
            return DefaultErrorResponse::create(null,  UnauthorizedException::forWrongRole()->getMessage());
        }

        return $next($request);
    }
}
