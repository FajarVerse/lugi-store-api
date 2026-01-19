<?php

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can get list products successfully', function () {
    $this->actingAsUser();

    $product = Product::factory()
        ->has(Variant::factory()->count(2))
        ->has(Attribute::factory()->count(2))
        ->create();

    $response = $this->getJson('/api/products/' . $product->slug);

    $response->assertStatus(200);
});
