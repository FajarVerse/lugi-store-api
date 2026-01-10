<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can detele category succesfully', function () {
    $this->actingAsUser();

    $category = Category::factory()->create();

    $response = $this->deleteJson('/api/categories/' . $category->id);

    $response->assertStatus(200);
});
