<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create new product successfully', function () {
    $this->actingAsUser();

    $category = Category::factory()->create();

    $response = $this->postJson('/api/products', [
        'name' => 'Kaos Polos',
        'description' => 'Kaos polos berbahan cotton combed 30 s dengan kualitas premium, nyaman dipakai harian.',
        'category_id' => $category->id,
        'variants' => [
            [
                'size' => 'M',
                'stock' => 20,
                'price' => 75000,
                'weight' => 1000,
            ],
        ],
        'product_attributes' => [
            [
                'name' => 'Bahan',
                'value' => 'Cotton Combed',
            ],
        ],
    ]);

    $response->assertStatus(201);
});
