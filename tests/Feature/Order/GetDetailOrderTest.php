<?php

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can get detail order successfully', function () {
    $user = $this->actingAsUser();

    $order = Order::factory()
        ->has(OrderItem::factory()->count(1))
        ->for($user)
        ->create();

    $response = $this->getJson('/api/orders/' . $order->order_code);

    $response->assertStatus(200);
});
