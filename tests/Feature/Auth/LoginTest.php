<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('can login user successfully', function () {
    $user  = User::factory()->create([
        'username' => 'nazwa123',
        'password' => Hash::make('Password123!'),
        'email' => 'nazwa@example.com',
        'name' => 'Nazwa Alfadillah'
    ]);

    $response = $this->postJson('/api/auth/login', [
        'username' => 'nazwa123',
        'password' => 'Password123!'
    ]);

    dump($response->json());

    $response->assertStatus(200);
});
