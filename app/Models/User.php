<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use HasFactory, Authenticatable, HasRoles, Authorizable;

    public const TABLE_NAME = 'users';

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_REMEMBER_TOKEN = 'remember_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_EMAIL,
        self::COLUMN_PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::COLUMN_PASSWORD,
        self::COLUMN_REMEMBER_TOKEN
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function brewCategories(): HasMany
    {
        return $this->hasMany(
            BrewProductCategory::class,
            BrewProductCategory::COLUMN_USER_ID,
            User::COLUMN_ID,
        );
    }

    public function brewProductCategories(): HasMany
    {
        return $this->hasMany(
            BrewProductCategory::class,
            BrewProductCategory::COLUMN_USER_ID,
            self::COLUMN_ID
        );
    }

    public function brewProducts(): HasMany
    {
        return $this->hasMany(
            BrewProduct::class,
            BrewProduct::COLUMN_USER_ID,
            self::COLUMN_ID
        );
    }
}
