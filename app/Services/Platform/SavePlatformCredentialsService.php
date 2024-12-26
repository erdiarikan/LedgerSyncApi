<?php

namespace App\Services\Platform;

use App\DTOs\PlatformAccessTokenDTO;
use App\Enums\PlatformsEnum;
use App\Models\PlatformCredential;
use Carbon\Carbon;

class SavePlatformCredentialsService
{
    public function savePlatformCredentials(
        PlatformAccessTokenDTO $platformAccessToken,
        PlatformsEnum $platformEnum
    ): PlatformCredential {
        return PlatformCredential::create([
            'platform_id' => $platformEnum,
            'id_token' => encrypt($platformAccessToken->idToken),
            'access_token' => $platformAccessToken->accessToken,
//            'access_token' => encrypt($platformAccessToken->accessToken),
            'access_token_created_at' => $platformAccessToken->accessTokenCreatedAt,
            'access_token_expires_at' => $platformAccessToken->accessTokenExpiresAt,
            'refresh_token' => $platformAccessToken->refreshToken,
//            'refresh_token' => encrypt($platformAccessToken->refreshToken),
            'refresh_token_created_at' => Carbon::now(),
            'refresh_token_expires_at' => Carbon::now()->addDays(config('xero.refresh_token_expires_in_days')),
            'scope' => $platformAccessToken->scope
        ]);
    }
}
