<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('can update profile users successfully', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->patchJson('/api/settings/profile-update', [
        'name' => 'Nazwa Alfa',
        'email' => 'nazwa@gmail.com',
        'phone' => '0293239231',
        'address' => 'Jl. Pegangsaan Timur, No. 12 Jakarta',
        'latitude' => -6.200000,
        'longitude' => 106.816666,
    ]);

    $response->assertStatus(200);
});

it('cant update profile users if data invalid', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->patchJson('/api/settings/profile-update', [
        'name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'latitude' => 0,
        'longitude' => 0
    ]);
    
    $response->assertStatus(422);
});
