<?php

namespace App\Http\Controllers;

use App\Contracts\Platform\PlatformAuthService;
use App\Contracts\Platform\PlatformTenantService;
use App\Http\Requests\PlatformOauth2CallbackRequest;
use App\Models\Company;
use App\Services\Platform\AssignTenantToCompanyService;
use App\Services\Platform\SavePlatformCredentialsService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class PlatformAuthController extends Controller
{
    private SavePlatformCredentialsService $savePlatformCredentialsService;
    private AssignTenantToCompanyService $assignTenantToCompanyService;

    public function __construct(
        SavePlatformCredentialsService $savePlatformCredentialsService,
        AssignTenantToCompanyService $assignTenantToCompanyService
    ) {
        $this->savePlatformCredentialsService = $savePlatformCredentialsService;
        $this->assignTenantToCompanyService = $assignTenantToCompanyService;
    }

    /**
     * @throws BindingResolutionException
     */
    public function __invoke(PlatformOauth2CallbackRequest $request)
    {
        $validated = $request->validated();

        $platform = $request->input('platform');

        $platformAuthService = app()->makeWith(PlatformAuthService::class, [
            'platform' => $platform,
        ]);

        // If the platform is not Xero, there might be a need to handle it differently.
        $company = Company::where('uuid', $validated['state'])->firstOrFail();

        try {
            $accessToken = $platformAuthService->exchangeCodeForToken($validated['code']);
            $platformCredential = $this->savePlatformCredentialsService->savePlatformCredentials(
                $accessToken,
                config("platforms.$platform.enum")
            );

            $platformTenantService = app()->makeWith(PlatformTenantService::class, [
                'platform' => $platform,
            ]);

            $platformTenants = $platformTenantService->fetchTenants($accessToken->accessToken)->data;

            return $this->assignTenantToCompanyService->assignTenantToCompany(
                $platformTenants,
                $company,
                $platformCredential
            );
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
