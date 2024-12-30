<?php

namespace App\Services\Xero;

use App\DTOs\Platform\PlatformApiResponseDTO;
use App\DTOs\Platform\PlatformTenantDTO;
use App\Enums\XeroEndpointsEnum;

readonly class XeroTenantService
{
    public function __construct(
        private XeroApiClientService $xeroApiClient
    ) {
    }


    public function fetchTenants(string $accessToken): PlatformApiResponseDTO
    {
        $response = $this->xeroApiClient->call(
            'get',
            XeroEndpointsEnum::CONNECTIONS->value,
            [
                'Authorization' => "Bearer $accessToken",
            ]
        );

        if ($response->isRateLimitExceeded()) {
            return $response;
        }

        $tenants = array_map(
            fn($org) => new PlatformTenantDTO($org),
            $response->data
        );

        return new PlatformApiResponseDTO(
            rateLimitExceeded: false,
            retryAt: null,
            data: $tenants
        );
    }

    /**
     * TODO: Implement fetchOrganisation method
    */
    public function fetchOrganisation(string $accessToken): PlatformApiResponseDTO
    {
        $response = $this->xeroApiClient->call(
            'get',
            "/organisation",
            [
                'Authorization' => "Bearer $accessToken",
                'Accept' => 'application/json',
            ]
        );

        if ($response->isRateLimitExceeded()) {
            return $response;
        }

        $tenants = array_map(
            fn($org) => new PlatformTenantDTO($org),
            $response->data
        );

        return new PlatformApiResponseDTO(
            rateLimitExceeded: false,
            retryAt: null,
            data: $tenants
        );
    }
}
