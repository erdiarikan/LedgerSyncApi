<?php

namespace App\Services;

namespace App\Services\Xero;

use App\Exceptions\XeroApiException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XeroAuthService
{
    /**
     * @throws XeroApiException
     * @throws ConnectionException
     */
    public function exchangeCodeForToken(string $code): array
    {
        $clientId = config('xero.client_id');
        $clientSecret = config('xero.client_secret');
        $redirectUri = config('xero.redirect_uri');
        $identityUrl = config('xero.identity_url');
        $tokenEndpoint = config('xero.token_endpoint');

        $response = Http::asForm()->post("{$identityUrl}{$tokenEndpoint}", [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        if ($response->failed()) {
            Log::error('Failed to exchange authorization code for access token.', [
                'response' => $response->body(),
            ]);
            throw new XeroApiException('Failed to exchange authorization code for access token.');
        }

        return $response->json();
    }
}
