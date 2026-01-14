<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can get list category successfully', function () {
    $this->actingAsUser();

    Category::factory()->create();

    $response = $this->getJson('/api/categories');

    $response->assertStatus(200);
});
