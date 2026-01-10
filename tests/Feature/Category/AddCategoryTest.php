<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can add new category successfuly', function () {
    $this->actingAsUser();

    $response = $this->postJson('/api/categories', [
        'categories' => [
            ['name' => 'clothes man'],
            ['name' => 'jeans']
        ]
    ]);

    $response->assertStatus(200);
});


it('cant add new category if data invalid', function () {
    $this->actingAsUser();

    $response = $this->postJson('/api/categories', [
        'categories' => [
            ['name' => 'sa'],
            ['name' => '']
        ]
    ]);

    $response->assertStatus(422);
});
