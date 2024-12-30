<?php

namespace App\Contracts\Platform;

use App\DTOs\Platform\PlatformAccessTokenDTO;

interface PlatformAuthService
{
    public function exchangeCodeForToken(string $code): PlatformAccessTokenDTO;
}
