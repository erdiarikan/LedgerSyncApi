<?php

it('registers a new user successfully', function () {
    $payload = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $response = $this->postJson('/api/register', $payload);

    $response->assertStatus(201);

    $response->assertJsonStructure([
        'user', 'access_token'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
});
