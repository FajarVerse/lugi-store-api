<?php

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can get orders successfully', function () {
    $user = $this->actingAsUser();

    Order::factory()
        ->has(OrderItem::factory()->count(1))
        ->for($user)
        ->create();

    $response = $this->getJson('/api/orders');

    $response->assertStatus(200);
});
