<?php

namespace App\Enums;

enum UserRolesEnum: string {
    case User = 'user';
    case Admin = 'admin';
    case Guest = 'guest';

    public static function getIndexedArrayOfRoles(): array
    {
        return [
            self::User->value,
            self::Admin->value,
            self::Guest->value,
        ];
    }
}
