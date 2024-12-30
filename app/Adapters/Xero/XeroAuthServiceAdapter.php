<?php

namespace App\Adapters\Xero;

use App\Contracts\Platform\PlatformAuthService;
use App\DTOs\Platform\PlatformAccessTokenDTO;
use App\Exceptions\XeroApiException;
use App\Services\Xero\XeroAuthService;
use Illuminate\Http\Client\ConnectionException;

class XeroAuthServiceAdapter implements PlatformAuthService
{
    private XeroAuthService $xeroAuthService;

    public function __construct(XeroAuthService $xeroAuthService)
    {
        $this->xeroAuthService = $xeroAuthService;
    }

    /**
     * @throws XeroApiException
     * @throws ConnectionException
     */
    public function exchangeCodeForToken(string $code): PlatformAccessTokenDTO
    {
        $rawResponse = $this->xeroAuthService->exchangeCodeForToken($code);

        return new PlatformAccessTokenDTO([
            'idToken' => $rawResponse['id_token'] ?? null,
            'accessToken' => $rawResponse['access_token'],
            'accessTokenExpiresIn' => $rawResponse['expires_in'] ?? null,
            'refreshToken' => $rawResponse['refresh_token'] ?? null,
            'refreshTokenExpiresIn' => config('xero.refresh_token_expires_in_days') * 24 * 60 * 60,
            'scope' => $rawResponse['scope'] ?? null,
        ]);
    }
}
