<?php

namespace App\Enums\BrewProduct;

// TODO: keep updating list once more statuses are known
use Illuminate\Support\Collection;

enum BrewProductStageEnum: string
{
    case AWAITING_FOR_START = 'awaiting_for_start'; // before start
    case FERMENTING = 'fermenting'; // 'active'
    case STOPPED_FERMENTATION = 'stopped_fermentation';
    case CLARIFYING = 'clarifying'; // in bottles already
    case FINISHED = 'finished';
    case FAILED = 'failed';

    public static function getCollection(): Collection
    {
        return collect([
            self::AWAITING_FOR_START,
            self::FERMENTING,
            self::STOPPED_FERMENTATION,
            self::CLARIFYING,
            self::FINISHED,
            self::FAILED
        ]);
    }
}
