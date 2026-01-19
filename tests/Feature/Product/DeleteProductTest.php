<?php

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('can delete product successfully', function () {
    $this->actingAsUser();

    $product = Product::factory()
        ->has(Variant::factory()->count(1))
        ->has(Attribute::factory()->count(1))
        ->create();

    $response = $this->deleteJson('/api/products/' . $product->id);

    $response->assertStatus(200);
});
