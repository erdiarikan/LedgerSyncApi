<?php

use App\Models\User;

beforeEach(function () {
    if (in_array('with-seeds', test()->groups())) {
        $this->seed();
    }
});

it('allows user to create a company', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'api')
        ->postJson('/api/companies', [
            'name' => 'Test Company',
        ])
        ->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
            ],
        ]);
})->group('with-seeds');

it('does not allow not logged user to create a company', function () {
    $this
        ->postJson('/api/companies', [
            'name' => 'Test Company',
        ])
        ->assertStatus(401);
});

it('does not allow user to create a company with invalid data', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'api')
        ->postJson('/api/companies')
        ->assertStatus(422);
})->group('with-seeds');
