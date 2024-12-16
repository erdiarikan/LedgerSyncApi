<?php

namespace App\Contracts\Platform;

interface PlatformTenantService
{
    public function fetchOrganisations(string $accessToken): array;
}
