<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('can change password user successfully', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->patchJson('/api/auth/change_password', [
        'current_password' => 'Rahasia123!',
        'password' => 'Rahasia1234!',
        'password_confirmation' => 'Rahasia1234!' 
    ]);

    dump($response->json());

    $response->assertStatus(200);
});
