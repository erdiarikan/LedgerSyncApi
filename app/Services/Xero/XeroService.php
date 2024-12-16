<?php

namespace App\Services\Xero;

use App\Exceptions\XeroApiException;
use App\Models\Company;
use App\Models\PlatformTenant;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class XeroService
{
    private string $baseUrl;
    private string $accessToken;
    private string $tenantId;
    private Company $company;

    public function __construct()
    {
        $this->baseUrl = config('xero.api_base_url');
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function setTenantId(string $tenantId): void
    {
        $this->tenantId = $tenantId;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    /**
     * @throws ConnectionException
     * @throws XeroApiException
     */
    public function fetchInvoices(): array
    {
        $response = Http::withToken($this->accessToken)
            ->get("{$this->baseUrl}/api.xro/2.0/Invoices");

        if ($response->failed()) {
            throw new XeroApiException('Failed to fetch invoices.');
        }

        return $response->json();
    }

    /**
     * @throws ConnectionException
     * @throws XeroApiException
     */
    public function fetchOrganisations(): array
    {
        $response = Http::withToken($this->accessToken)
            ->get("{$this->baseUrl}/connections");

        if ($response->failed()) {
            throw new XeroApiException('Failed to fetch connections.');
        }

        return $response->json();
    }

    /**
     * @throws XeroApiException
     * @throws ConnectionException
     */
    public function assignTenantToCompany(): JsonResponse
    {
        $organisations = $this->fetchOrganisations();

        if (count($organisations) === 1) {
            $tenant = $this->saveTenant($organisations);
            return response()->json([
                'success' => true,
                'message' => "{$organisations[0]['tenantName']} on Xero is connected to your company",
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Multiple organisations found, please select one.',
            'organisations' => $organisations,
        ]);
    }

    private function saveTenant($organisations): PlatformTenant
    {
        return PlatformTenant::updateOrCreate(
            [
                'tenant_id' => $organisations[0]['tenantId'],
            ],
            [
                'platform_id' => $organisations[0]['id'],
                'tenant_id' => $organisations[0]['tenantId'],
                'tenant_type' => $organisations[0]['tenantType'],
                'tenant_name' => $organisations[0]['tenantName'],
                'tenant_created_at' => Carbon::parse($organisations[0]['createdDateUtc']),
                'tenant_updated_at' => Carbon::parse($organisations[0]['updatedDateUtc'])
            ]
        );
    }
}
