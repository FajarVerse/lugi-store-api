<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_code' => 'ORD-' . now()->format('Ymd') . '-' . Str::padLeft($this->faker->unique()->numberBetween(1, 99999), 5, '0'),
            'status' => 'pending',
            'total_price' => 0,
            'shipping_address' => $this->faker->address(),
            'payment_method' => $this->faker->randomElement(['gopay', 'bca_va', 'bni_va']),
            'paid_at' => null,
        ];
    }
}
