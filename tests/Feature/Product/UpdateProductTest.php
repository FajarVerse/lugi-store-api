<?php

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can update product successfully', function () {
    $this->actingAsUser();

    $product = Product::factory()
        ->has(Variant::factory()->count(1))
        ->has(Attribute::factory()->count(1))
        ->create();


    $response = $this->patchJson('/api/products/' . $product->id, [
        'name' => 'Kaos Polos',
        'description' => 'Kaos polos berbahan cotton combed 30 s dengan kualitas premium, nyaman dipakai harian.',
        'variants' => [
            [
                'id' => 1,
                'size' => 'M',
                'stock' => 22,
                'price' => 8000,
                'weight' => 1000,
            ],
        ],
        'attributes' => [
            [
                'id' => 1,
                'name' => 'Bahan',
                'value' => 'Cotton Combed',
            ],
        ],
    ]);

    $response->assertStatus(200);
});
