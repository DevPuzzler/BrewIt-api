<?php

namespace App\Http\Services\BrewCategory;

use App\Models\BrewCategory;
use App\Tools\ValueObjects\Queries\BrewCategory\CreateBrewCategoryQuery;

class BrewCategoryService
{
    public function __construct(
        protected readonly BrewCategory $brewCategoryModel
    ) {}

    public function create( CreateBrewCategoryQuery $query ): BrewCategory
    {
        return $this->brewCategoryModel->create($query->getDataForCreate()->toArray());
    }
}
