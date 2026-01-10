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

    dump($response->json());

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

    dump($response->json());

    $response->assertStatus(422);
});
