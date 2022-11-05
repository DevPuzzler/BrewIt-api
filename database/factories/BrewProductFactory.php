<?php

namespace Database\Factories;

use App\Models\BrewProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BrewProduct>
 */
class BrewProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            BrewProduct::COLUMN_NAME => $this->faker->domainName(),
            BrewProduct::COLUMN_DESCRIPTION => $this->faker->text(),
        ];
    }
}
