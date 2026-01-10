<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can update category successfully', function () {
    $this->actingAsUser();

    $category = Category::factory()->create();

    $response = $this->patchJson('/api/categories/' . $category->id, [
        'name' => 'woman clothes'
    ]);

    $response->assertStatus(200);
});
