<?php

namespace App\Http\Controllers\Xero;

use App\Contracts\Platform\PlatformAuthService;
use App\Contracts\Platform\PlatformTenantService;
use App\Enums\PlatformsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\XeroCallbackRequest;
use App\Models\Company;
use App\Services\Platform\AssignTenantToCompanyService;
use App\Services\Platform\SavePlatformCredentialsService;

class XeroAuthController extends Controller
{
    private PlatformAuthService $platformAuthService;
    private SavePlatformCredentialsService $savePlatformCredentialsService;
    private PlatformTenantService $platformTenantService;
    private AssignTenantToCompanyService $assignTenantToCompanyService;

    public function __construct(
        PlatformAuthService $platformAuthService,
        SavePlatformCredentialsService $savePlatformCredentialsService,
        PlatformTenantService $platformTenantService,
        AssignTenantToCompanyService $assignTenantToCompanyService
    ) {
        $this->platformAuthService = $platformAuthService;
        $this->savePlatformCredentialsService = $savePlatformCredentialsService;
        $this->platformTenantService = $platformTenantService;
        $this->assignTenantToCompanyService = $assignTenantToCompanyService;
    }

    public function __invoke(XeroCallbackRequest $request)
    {
        $validated = $request->validated();
        $company = Company::where('uuid', $validated['state'])->firstOrFail();

        try {
            $accessToken = $this->platformAuthService->exchangeCodeForToken($validated['code']);
            $platformCredential = $this->savePlatformCredentialsService->savePlatformCredentials(
                $accessToken,
                PlatformsEnum::XERO
            );
            $platformTenants = $this->platformTenantService->fetchOrganisations($accessToken->accessToken);

            return $this->assignTenantToCompanyService->assignTenantToCompany(
                $platformTenants,
                $company,
                $platformCredential
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
