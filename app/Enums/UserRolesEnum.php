<?php

namespace App\Enums;

enum UserRolesEnum: string {
    case USER = 'user';
    case ADMIN = 'admin';
    case GUEST = 'guest';

    /**
     * Order does matter because it is used to check prior of roles.
     */
    public static function getIndexedArrayOfRoles(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::GUEST->value,
        ];
    }

    public static function isUserRoleHigherOrEqualPriority(self $userRole, self $requiredRole): bool
    {
        $indexedRolesArr = self::getIndexedArrayOfRoles();

        return array_search($userRole->value, $indexedRolesArr) <= array_search($requiredRole->value, $indexedRolesArr);
    }

}
