<?php

namespace App\Adapters\Xero;

use App\Contracts\Platform\PlatformChartOfAccountsService;
use App\DTOs\Platform\PlatformApiResponseDTO;
use App\DTOs\Platform\PlatformChartOfAccountDTO;
use App\Exceptions\XeroApiException;
use App\Helpers\DTOArrayValidator;
use App\Services\Xero\XeroChartOfAccountService;
use Illuminate\Http\Client\ConnectionException;

class XeroChartOfAccountServiceAdapter implements PlatformChartOfAccountsService
{
    private XeroChartOfAccountService $chartOfAccountService;

    public function __construct(XeroChartOfAccountService $chartOfAccountService)
    {
        $this->chartOfAccountService = $chartOfAccountService;
    }

    /**
     * @throws XeroApiException
     * @throws ConnectionException
     */
    public function fetchChartOfAccounts(string $accessToken): PlatformApiResponseDTO
    {
        $fetchChartOfAccountsData = $this->chartOfAccountService->fetchChartOfAccounts($accessToken);
        $chartOfAccounts = $fetchChartOfAccountsData->data;

        if (is_null($chartOfAccounts)) {
            throw new XeroApiException('Retry at ' . $fetchChartOfAccountsData->retryAt);
        }

        if (!DTOArrayValidator::validate($chartOfAccounts, PlatformChartOfAccountDTO::class)) {
            throw new XeroApiException('Invalid chart of account data.');
        }

        return $chartOfAccounts;
    }
}
