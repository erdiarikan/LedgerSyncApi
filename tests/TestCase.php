<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\ClientRepository;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class)
    ->in('Feature/Auth');

abstract class TestCase extends BaseTestCase
{
    protected function setUpPassport(): void
    {
        $this->artisan('migrate');

        $clientRepository = new ClientRepository();

        $personalClient = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            'http://localhost'
        );

        $passwordGrantClient = $clientRepository->createPasswordGrantClient(
            null,
            'Test Password Grant Client',
            'http://localhost'
        );

        config([
            'passport.personal_access_client.id' => $personalClient->id,
            'passport.personal_access_client.secret' => $personalClient->plainSecret,
            'passport.password_grant_client.id' => $passwordGrantClient->id,
            'passport.password_grant_client.secret' => $passwordGrantClient->plainSecret,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpPassport();
    }
}
