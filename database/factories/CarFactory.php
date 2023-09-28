<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_name' => fake()->name(),
            'description' => fake()->text(),
            'product_year' => fake()->numberBetween(2000, 2023),
            'price' => fake()->numberBetween(),
            'manufacturer_id' => fake()->unique()->numberBetween()
        ];
    }
}
