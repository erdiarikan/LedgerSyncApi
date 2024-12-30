<?php

namespace App\Services\Xero;

use App\DTOs\Platform\PlatformApiResponseDTO;
use App\DTOs\Platform\PlatformChartOfAccountDTO;
use App\DTOs\Platform\PlatformTenantDTO;
use App\Enums\XeroEndpointsEnum;

readonly class XeroChartOfAccountService
{
    public function __construct(
        private XeroApiClientService $xeroApiClient
    ) {
    }


    public function fetchChartOfAccounts(string $accessToken): PlatformApiResponseDTO
    {
        $response = $this->xeroApiClient->call(
            'get',
            XeroEndpointsEnum::CHART_OF_ACCOUNTS->value,
            [
                'Authorization' => "Bearer $accessToken",
                'Accept' => 'application/json',
            ]
        );

        if ($response->isRateLimitExceeded()) {
            return $response;
        }

        $chartOfAccounts = array_map(
            fn($org) => new PlatformChartOfAccountDTO($org),
            $response->data
        );

        return new PlatformApiResponseDTO(
            rateLimitExceeded: false,
            retryAt: null,
            data: $chartOfAccounts
        );
    }
}
