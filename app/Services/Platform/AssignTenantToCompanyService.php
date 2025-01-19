<?php

namespace App\Services\Platform;

use App\Contracts\Platform\AssignPlatformTenantToCompanyService;
use App\DTOs\Platform\PlatformTenantDTO;
use App\Models\Company;
use App\Models\PlatformCredential;
use Illuminate\Http\JsonResponse;

readonly class AssignTenantToCompanyService implements AssignPlatformTenantToCompanyService
{
    public function __construct(
        private SavePlatformTenantService $platformTenantService,
    )
    {
    }

    public function assignTenantToCompany(
        array $platformTenants,
        Company $company,
        PlatformCredential $platformCredential
    ): JsonResponse {
        $statusCode = 200;

        $response = match (true) {
            empty($platformTenants) => [
                'success' => false,
                'message' => 'No Organisation is found.',
                'status' => 500,
            ],
//            count($platformTenants) > 1 => [
//                'success' => false,
//                'message' => 'Multiple organisations found, please select one.',
//                'organisations' => $platformTenants,
//                'status' => 400,
//            ],
            count($platformTenants) > 1 =>
                $this->processSingleTenant($platformTenants[1], $company, $platformCredential),

            default => $this->processSingleTenant($platformTenants[0], $company, $platformCredential)
        };

        $statusCode = $response['status'] ?? $statusCode;
        unset($response['status']);

        return response()->json($response, $statusCode);
    }

    private function processSingleTenant(
        PlatformTenantDTO $platformTenantData,
        Company $company,
        PlatformCredential $platformCredential
    ): array {
        $tenant = $this->platformTenantService->savePlatformTenant($platformTenantData, $platformCredential);

        if ($company->platformTenants()->where('platform_tenant_id', $tenant->id)->exists()) {
            return [
                'success' => false,
                'message' => 'The tenant is already assigned to this company.',
                'status' => 400,
            ];
        }

        $company->platformTenants()->attach($tenant);

        return [
            'success' => true,
            'message' => 'The tenant is successfully assigned to the company.',
            'status' => 200,
        ];
    }
}
