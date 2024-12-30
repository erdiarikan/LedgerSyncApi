<?php

namespace App\Adapters\Xero;

use App\Contracts\Platform\PlatformTenantService;
use App\DTOs\Platform\PlatformApiResponseDTO;
use App\DTOs\Platform\PlatformTenantDTO;
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
    public function fetchTenants(string $accessToken): PlatformApiResponseDTO
    {
        $fetchOrganisationsData = $this->xeroTenantService->fetchTenants($accessToken);
        $organisations = $fetchOrganisationsData->data;

        if (is_null($organisations)) {
            throw new XeroApiException('Retry at ' . $fetchOrganisationsData->retryAt);
        }

        if (!DTOArrayValidator::validate($organisations, PlatformTenantDTO::class)) {
            throw new XeroApiException('Invalid organisation data.');
        }

        return $organisations;
    }

    /**
     * @throws XeroApiException
     */
    public function fetchOrganisation(string $accessToken): PlatformApiResponseDTO
    {
        $fetchOrganisationsData = $this->xeroTenantService->fetchOrganisation($accessToken);
        $organisations = $fetchOrganisationsData->data;

        if (is_null($organisations)) {
            throw new XeroApiException('Retry at ' . $fetchOrganisationsData->retryAt);
        }

        if (!DTOArrayValidator::validate($organisations, PlatformTenantDTO::class)) {
            throw new XeroApiException('Invalid organisation data.');
        }

        return $organisations;
    }
}
