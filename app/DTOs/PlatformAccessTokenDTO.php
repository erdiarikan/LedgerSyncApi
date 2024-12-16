<?php

namespace App\DTOs;

use Carbon\Carbon;

class PlatformAccessTokenDTO
{
    public ?string $idToken;
    public string $accessToken;
    public Carbon $accessTokenCreatedAt;
    public Carbon $accessTokenExpiresAt;
    public string $refreshToken;
    public Carbon $refreshTokenCreatedAt;
    public ?Carbon $refreshTokenExpiresAt;

    public ?string $scope;


    public function __construct(array $data)
    {
        $this->idToken = $data['idToken'] ?? null;
        $this->accessToken = $data['accessToken'] ?? throw new \InvalidArgumentException('AccessToken is required.');
        $this->accessTokenCreatedAt = Carbon::now();
        $this->accessTokenExpiresAt = $data['accessTokenExpiresIn'] ?
            Carbon::now()->addSeconds($data['accessTokenExpiresIn']) :
            throw new \InvalidArgumentException('AccessTokenExpiresIn is required.');
        $this->refreshToken = $data['refreshToken'] ?? throw new \InvalidArgumentException('RefreshToken is required.');
        $this->refreshTokenCreatedAt = Carbon::now();
        $this->refreshTokenExpiresAt = $data['refreshTokenExpiresIn'] ?
            Carbon::now()->addSeconds($data['refreshTokenExpiresIn']) : null;
        $this->scope = $data['scope'] ?? null;
    }
}
