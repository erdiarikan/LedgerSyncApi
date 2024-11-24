<?php

beforeEach(function () {
    $payload = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->postJson('/api/register', $payload);

    $loginPayload = [
        'email' => 'test@example.com',
        'password' => 'password123',
    ];

    $response = $this->postJson('/api/login', $loginPayload);

    $this->accessToken = $response['access_token'];
});

it('logs out a user successfully', function () {
    $response = $this->postJson('/api/logout', [], [
        'Authorization' => "Bearer {$this->accessToken}",
    ]);

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'message'
    ]);

    $response->assertJson([
        'message' => 'Logged out successfully'
    ]);
});
