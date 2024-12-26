<?php

namespace App\Services\Xero;

use App\DTOs\PlatformTenantDTO;
use PlatformApiResponseDTO;

class XeroTenantService
{
    private string $baseUrl;

    public function __construct(
        private readonly XeroApiClientService $apiClient
    ) {
        $this->baseUrl = config('xero.api_base_url');
    }


    public function fetchOrganisations(string $accessToken): PlatformApiResponseDTO
    {
        $response = $this->apiClient->call(
            'get',
            "$this->baseUrl/connections",
            [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ],
            ]
        );

        if ($response->isRateLimitExceeded()) {
            return $response;
        }

        $organisations = array_map(
            fn($org) => new PlatformTenantDTO($org),
            $response->data
        );

        return new PlatformApiResponseDTO(
            rateLimitExceeded: false,
            retryAt: null,
            data: $organisations
        );
    }
}
