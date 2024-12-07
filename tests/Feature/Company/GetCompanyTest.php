<?php

use App\Models\Company;
use App\Models\User;

beforeEach(function () {
    if (in_array('with-seeds', test()->groups())) {
        $this->seed();
    }
});

it('allows user to get their company', function () {
    $user = User::factory()->create();

    $company = Company::factory()->create();
    $user->companies()->attach($company->uuid, ['role' => 1]);

    $this->actingAs($user, 'api')
        ->getJson("/api/companies/{$company->uuid}")
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'uuid' => $company->uuid,
                'name' => $company->name,
            ],
        ]);
})->group('with-seeds');

it('does not allow not logged user to get a company', function () {
    $user = User::factory()->create();

    $company = Company::factory()->create();
    $user->companies()->attach($company->uuid, ['role' => 1]);

    $this->getJson("/api/companies/{$company->uuid}")
        ->assertStatus(401);
})->group('with-seeds');

it('does not allow user to get a company which does not belong to them', function () {
    $user = User::factory()->create();

    $company = Company::factory()->create();
    $user->companies()->attach($company->uuid, ['role' => 1]);

    $user2 = User::factory()->create();

    $this->actingAs($user2, 'api')
        ->getJson("/api/companies/{$company->uuid}")
        ->assertStatus(403);
})->group('with-seeds');

it('does not allow user to get a company which does not exist', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'api')
        ->getJson("/api/companies/123")
        ->assertStatus(404);
})->group('with-seeds');
