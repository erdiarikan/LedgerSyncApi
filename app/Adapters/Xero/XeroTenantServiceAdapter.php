<?php

namespace App\Adapters\Xero;

use App\Contracts\Platform\PlatformTenantService;
use App\DTOs\PlatformTenantDTO;
use App\Exceptions\XeroApiException;
use App\Helpers\DTOArrayValidator;
use App\Services\Xero\XeroTenantService;
use Illuminate\Http\Client\ConnectionException;

class XeroTenantServiceAdapter implements PlatformTenantService
{
    private XeroTenantService $xeroTenantService;

    public function __construct(XeroTenantService $xeroTenantService)
    {
        $this->xeroTenantService = $xeroTenantService;
    }

    /**
     * @throws XeroApiException
     * @throws ConnectionException
     */
    public function fetchOrganisations(string $accessToken): array
    {
        $organisations = $this->xeroTenantService->fetchOrganisations($accessToken);

        if (!DTOArrayValidator::validate($organisations, PlatformTenantDTO::class)) {
            throw new XeroApiException('Invalid organisation data.');
        }

        return $organisations;
    }
}
