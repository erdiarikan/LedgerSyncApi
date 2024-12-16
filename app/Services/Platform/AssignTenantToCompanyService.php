<?php

namespace App\Services\Platform;

use App\Contracts\Platform\AssignPlatformTenantToCompanyService;
use App\Enums\PlatformEnum;
use App\Models\Company;
use App\Models\PlatformCredential;
use Illuminate\Http\JsonResponse;

class AssignTenantToCompanyService implements AssignPlatformTenantToCompanyService
{
    private SavePlatformTenantService $platformTenantService;

    public function __construct(
        SavePlatformTenantService $platformTenantService,
    ) {
        $this->platformTenantService = $platformTenantService;
    }

    public function assignTenantToCompany(
        array $platformTenants,
        Company $company,
        PlatformCredential $platformCredential
    ): JsonResponse {
        if (empty($platformTenants)) {
            return response()->json([
                'success' => false,
                'message' => 'No Organisation is found.',
            ], 500);
        }

        if (count($platformTenants) === 1) {
            $tenant = $this->platformTenantService->savePlatformTenant(
                $platformTenants[0],
                $platformCredential
            );

            $company->platformTenants()->attach($tenant);

            return response()->json([
                'success' => true,
                'message' => 'Organisation is attached to the tenant',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Multiple organisations found, please select one.',
            'organisations' => $platformTenants,
        ]);
    }
}
