<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrewCategory extends Model
{
    use HasFactory, SoftDeletes;

    public const TABLE_NAME = 'brew_categories';

    public const COLUMN_ID = 'id';
    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_USER_ID
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            self::COLUMN_USER_ID,
            User::COLUMN_ID
        );
    }
}
