<?php

beforeEach(function () {
    $payload = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->postJson('/api/register', $payload);
});


it('logs in a user successfully', function () {
    $payload = [
        'email' => 'test@example.com',
        'password' => 'password123',
    ];

    $response = $this->postJson('/api/login', $payload);

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'user', 'access_token'
    ]);
});
