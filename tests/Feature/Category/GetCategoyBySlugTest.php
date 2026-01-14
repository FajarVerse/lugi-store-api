<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can get category by slug successfully', function () {
    $this->actingAsUser();

    $category = Category::factory()->create();

    $response = $this->getJson('/api/categories/' . $category->slug);

    $response->assertStatus(200);
});
