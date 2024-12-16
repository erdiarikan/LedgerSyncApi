<?php

namespace App\Services\Xero;

use App\DTOs\PlatformTenantDTO;
use App\Exceptions\XeroApiException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class XeroTenantService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('xero.api_base_url');
    }
    /**
     * @throws ConnectionException
     * @throws XeroApiException
     */
    public function fetchOrganisations(string $accessToken): array
    {
        $response = Http::withToken($accessToken)
            ->get("$this->baseUrl/connections");

        if ($response->failed()) {
            throw new XeroApiException('Failed to fetch organisations.');
        }

        $organisations = $response->json();

        return array_map(fn($org) => new PlatformTenantDTO($org), $organisations);
    }
}
