<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('can logout user successfully', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->deleteJson('/api/auth/logout');

    dump($response->json());
    $response->assertStatus(200);
});
