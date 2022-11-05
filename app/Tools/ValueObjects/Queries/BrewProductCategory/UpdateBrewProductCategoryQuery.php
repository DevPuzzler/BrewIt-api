<?php

namespace App\Tools\ValueObjects\Queries\BrewProductCategory;

use App\Models\BrewProductCategory;
use Illuminate\Support\Collection;

class UpdateBrewProductCategoryQuery
{
    public function __construct(
        protected readonly int $id,
        protected readonly string $name,
        protected readonly string $description
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDataForUpdate(): Collection
    {
        return collect([
            BrewProductCategory::COLUMN_NAME => $this->getName(),
            BrewProductCategory::COLUMN_DESCRIPTION => $this->getDescription(),
        ]);
    }
}
