<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Product of brewing, f.ex. Wine, Beer, Cider
 */
class BrewProduct extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'brew_products';

    public const COLUMN_ID = 'id';
    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_PRODUCT_CATEGORY_ID = 'product_category_id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_DESCRIPTION = 'description';
    // TODO: add stages of brewing
    // TODO: ADD INGREDIENTS
    // TODO: add notes
    // TODO: add images

    protected $fillable = [
        self::COLUMN_USER_ID,
        self::COLUMN_PRODUCT_CATEGORY_ID,
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            User::COLUMN_ID,
            self::COLUMN_USER_ID
        );
    }

    public function brewProductCategory(): BelongsTo
    {
        return $this->belongsTo(
            BrewProductCategory::class,
            self::COLUMN_PRODUCT_CATEGORY_ID,
            BrewProductCategory::COLUMN_ID,
        );
    }
}
