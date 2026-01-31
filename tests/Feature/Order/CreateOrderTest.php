<?php

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create order successfully', function () {
    $user = $this->actingAsUser();

    $product = Product::factory()->create();

    $variant = Variant::factory()->create([
        'product_id' => $product->id,
        'price' => 100000,
        'stock' => 10,
    ]);

    Attribute::factory()->create([
        'product_id' => $product->id,
    ]);


    $payload = [
        'shipping_address' => 'jl. Merdeka No. 10, Jakarta Pusat, DKI Jakarta 10110',
        'payment_method' => 'gopay',
        'items' => [
            [
                'variant_id' => $variant->id,
                'quantity' => 2,
            ],
        ],
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(201);

    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id,
        'status' => 'pending',
        'total_price' => 200000
    ]);

    $this->assertDatabasehas('order_items', [
        'variant_id' => $variant->id,
        'quantity' => 2,
        'price' => 100000,
        'subtotal' => 200000
    ]);

    $this->assertDatabaseHas('variants', [
        'id' => $variant->id,
        'stock' => 8
    ]);
});
