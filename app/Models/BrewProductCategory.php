<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BrewProductCategory extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'brew_product_categories';

    public const COLUMN_ID = 'id';
    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_DESCRIPTION = 'description';

    protected $fillable = [
        self::COLUMN_USER_ID,
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            self::COLUMN_USER_ID,
            User::COLUMN_ID,
        );
    }

    public function brewProducts(): HasMany
    {
        return $this->hasMany(
            BrewProduct::class,
            BrewProduct::COLUMN_PRODUCT_CATEGORY_ID,
            self::COLUMN_ID
        );
    }
}
