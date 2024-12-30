<?php

namespace App\Contracts\Platform;

use App\DTOs\Platform\PlatformApiResponseDTO;

interface PlatformChartOfAccountsService
{
    public function fetchChartOfAccounts(string $accessToken): PlatformApiResponseDTO;
}
