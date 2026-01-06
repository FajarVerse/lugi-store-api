<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can register user successfully', function () {
    $response = $this->postJson('/api/auth/register', [
        'username' => 'nazwa123',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'name' => 'Nazwa Alfadillah',
        'email' => 'nazwa@example.com',
        'phone' => '081234567890',
    ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'username' => 'nazwa123',
        'email' => 'nazwa@example.com'
    ]);
});

it('cant register user if data must blank', function () {
    $response = $this->postJson('/api/auth/register', [
        'username' => '',
        'password' => '',
        'password_confirmation' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
    ]);

    $response->assertStatus(422);
});
