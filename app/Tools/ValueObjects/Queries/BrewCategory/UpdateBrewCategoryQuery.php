<?php

namespace App\Tools\ValueObjects\Queries\BrewCategory;

use App\Models\BrewCategory;
use Illuminate\Support\Collection;

class UpdateBrewCategoryQuery
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
            BrewCategory::COLUMN_NAME => $this->getName(),
            BrewCategory::COLUMN_DESCRIPTION => $this->getDescription(),
        ]);
    }
}
