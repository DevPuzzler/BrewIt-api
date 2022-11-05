<?php

namespace Database\Factories;

use App\Models\BrewProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BrewProductCategory>
 */
class BrewProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            BrewProductCategory::COLUMN_NAME => $this->faker->colorName(),
            BrewProductCategory::COLUMN_DESCRIPTION => $this->faker->text(),
        ];
    }
}
