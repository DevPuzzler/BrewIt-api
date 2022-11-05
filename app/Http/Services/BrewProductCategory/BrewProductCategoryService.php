<?php

namespace App\Http\Services\BrewProductCategory;

use App\Models\BrewProductCategory;
use App\Models\User;
use App\Tools\ValueObjects\Queries\BrewProductCategory\CreateBrewProductCategoryQuery;
use App\Tools\ValueObjects\Queries\BrewProductCategory\UpdateBrewProductCategoryQuery;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class BrewProductCategoryService
{
    public function __construct(
        protected readonly BrewProductCategory $brewProductCategoryModel
    ) {}

    public function getCollectionForUser ( Authenticatable|User $user ): Collection
    {
        return $this->brewProductCategoryModel->where(
            BrewProductCategory::COLUMN_USER_ID , $user->getAttribute(User::COLUMN_ID)
        )->get();
    }

    public function getById( int $id ): BrewProductCategory {
        return BrewProductCategory::find($id);
    }

    public function create(CreateBrewProductCategoryQuery $query ): BrewProductCategory
    {
        return $this->brewProductCategoryModel->create($query->getDataForCreate()->toArray());
    }

    public function update(UpdateBrewProductCategoryQuery $query ): void
    {
        $brewProductCategory = $this->getById($query->getId());
        $brewProductCategory->update($query->getDataForUpdate()->toArray());
    }

    public function delete( int $id ): bool
    {
        return $this->getById($id)->delete();
    }
}
