<?php

namespace App\Contracts\Platform;

use App\DTOs\Platform\PlatformApiResponseDTO;

interface PlatformTenantService
{
    public function fetchTenants(string $accessToken): PlatformApiResponseDTO;
    public function fetchOrganisation(string $accessToken): PlatformApiResponseDTO;
}
