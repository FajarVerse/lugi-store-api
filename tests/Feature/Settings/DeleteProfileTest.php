<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('can delete profile user successfully', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->deleteJson('/api/settings/profile-delete', [
        'password' => 'Rahasia123!'
    ]);

    $response->assertStatus(200);
});
