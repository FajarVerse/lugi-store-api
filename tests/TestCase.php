<?php

namespace Tests;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    protected function actingAsUser(array $attributes = []): User
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        return $user;
    }

    protected function createProduct(array $attributes = []): Product
    {
        return Product::factory()
            ->has(Variant::factory()->state([
                'price' => 100000,
                'stock' => 10,
                'size' => 's',
                'weight' => 1000
            ]))
            ->has(Attribute::factory()->count(1))
            ->create();
    }
}
