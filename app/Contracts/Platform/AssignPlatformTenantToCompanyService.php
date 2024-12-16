<?php

namespace App\Contracts\Platform;

use App\Models\Company;
use App\Models\PlatformCredential;
use Illuminate\Http\JsonResponse;

interface AssignPlatformTenantToCompanyService
{
    public function assignTenantToCompany(
        array $platformTenants,
        Company $company,
        PlatformCredential $platformCredential
    ): JsonResponse;
}
