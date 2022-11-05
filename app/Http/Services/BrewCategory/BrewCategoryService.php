<?php

namespace App\Http\Services\BrewCategory;

use App\Models\BrewCategory;
use App\Models\User;
use App\Tools\ValueObjects\Queries\BrewCategory\CreateBrewCategoryQuery;
use App\Tools\ValueObjects\Queries\BrewCategory\UpdateBrewCategoryQuery;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class BrewCategoryService
{
    public function __construct(
        protected readonly BrewCategory $brewCategoryModel
    ) {}

    public function getCollectionForUser ( Authenticatable|User $user ): Collection
    {
        return $this->brewCategoryModel->where(
            BrewCategory::COLUMN_USER_ID , $user->getAttribute(User::COLUMN_ID)
        )->get();
    }

    public function getById( int $id ): BrewCategory {
        return BrewCategory::find($id);
    }

    public function create( CreateBrewCategoryQuery $query ): BrewCategory
    {
        return $this->brewCategoryModel->create($query->getDataForCreate()->toArray());
    }

    public function update( UpdateBrewCategoryQuery $query ): void
    {
        $brewCategory = $this->getById($query->getId());
        $brewCategory->update($query->getDataForUpdate()->toArray());
    }

    public function delete( int $id ): bool
    {
        return $this->getById($id)->delete();
    }
}
