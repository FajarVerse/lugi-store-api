<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => $this->faker->randomElement(['s', 'm', 'l', 'xl']),
            'stock' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->numberBetween(50000, 150000),
            'weight' => $this->faker->numberBetween(150, 500), // gram
        ];
    }
}
