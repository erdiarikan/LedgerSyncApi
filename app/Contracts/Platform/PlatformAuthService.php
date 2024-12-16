<?php

namespace App\Contracts\Platform;

use App\DTOs\PlatformAccessTokenDTO;

interface PlatformAuthService
{
    public function exchangeCodeForToken(string $code): PlatformAccessTokenDTO;
}
