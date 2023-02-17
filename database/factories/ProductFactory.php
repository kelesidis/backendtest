<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'type' => fake()->randomElement(['Excursions', 'Custom Packages', 'Cruises ', ' Transfers']),
            'description' => fake()->paragraph(3),
            'capacity' => fake()->numberBetween(1, 10),
        ];
    }
}
