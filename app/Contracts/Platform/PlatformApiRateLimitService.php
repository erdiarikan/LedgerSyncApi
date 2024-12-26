<?php

namespace App\Contracts\Platform;

use App\Models\PlatformTenant;

interface PlatformApiRateLimitService
{
    public function rateLimitCheck(PlatformTenant $platformTenant): array;
}
