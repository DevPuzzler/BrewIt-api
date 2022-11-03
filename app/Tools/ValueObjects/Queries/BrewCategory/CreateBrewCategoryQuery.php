<?php

namespace App\Tools\ValueObjects\Queries\BrewCategory;

use App\Models\BrewCategory;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

class CreateBrewCategoryQuery
{
    public function __construct(
        protected readonly Authenticatable|User $user,
        protected readonly string $name,
        protected readonly string $description
    ) {}

    public function getUser(): User
    {
        return $this->user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDataForCreate(): Collection
    {
        return collect([
            BrewCategory::COLUMN_NAME => $this->getName(),
            BrewCategory::COLUMN_DESCRIPTION => $this->getDescription(),
            BrewCategory::COLUMN_USER_ID => $this->getUser()->getAttribute(User::COLUMN_ID),
        ]);
    }
}
