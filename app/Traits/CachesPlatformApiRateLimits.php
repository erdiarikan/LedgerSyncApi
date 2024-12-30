<?php

namespace App\Traits;

use App\DTOs\Platform\PlatformRetryAtDTO;
use App\Models\PlatformTenant;
use Cache;

trait CachesPlatformApiRateLimits
{
    public function checkRateLimit(
        PlatformTenant $platformTenant
    ): bool {
        $cachePlatformPrefix = "{$platformTenant->platformCredential->platform->name}_";
        $cachePlatformTenantPrefix = "{$platformTenant->platform_id}_";

        $platformExceedLimitKey = "{$cachePlatformPrefix}_{$cachePlatformTenantPrefix}_exceed_limit";

        $platformExceedLimit = Cache::get($platformExceedLimitKey);

        if (is_null($platformExceedLimit)) {
            return true;
        }

        return $platformExceedLimit;
    }

    public function cacheRateLimit(
        PlatformTenant $platformTenant,
        PlatformRetryAtDTO $retryAtDTO
    ): void {
        $cachePlatformPrefix = "{$platformTenant->platformCredential->platform->name}_";
        $cachePlatformTenantPrefix = "{$platformTenant->platform_id}_";

        $platformExceedLimitKey = "{$cachePlatformPrefix}_{$cachePlatformTenantPrefix}_exceed_limit";

        Cache::put($platformExceedLimitKey, [], $retryAtDTO->retryAt);

        $cacheKeyPrefix = "{$platformTenant->platformCredential->platform->name}_{$platformTenant->platform_id}_";

        $tenantDayLimitRemaining = Cache::get("{$cacheKeyPrefix}_day_limit_remaining");

        if (is_null($tenantDayLimitRemaining)) {
            Cache::put("{$cacheKeyPrefix}_day_limit_remaining", $rateLimitDTO->tenantDayLimit, now()->addDay());
        }

        $rateLimits = [
            'day_limit_remaining' => $rateLimitDTO->tenantDayLimit ?? null,
            'app_min_limit_remaining' => $rateLimitDTO->appMinLimit ?? null,
            'min_limit_remaining' => $rateLimitDTO->tenantMinLimit ?? null,
        ];

        foreach ($rateLimits as $key => $value) {
            if ($key = 'day_limit_remaining' && $value === 0) {
                Cache::put($cacheKeyPrefix . $key, $value, now()->addMinutes(30));
            }
            if ($value !== null) {
                Cache::put($cacheKeyPrefix . $key, $value, now()->addMinutes(30));
            }
        }
    }

    public function getRateLimit(string $platform, string $tenantId, string $key): ?int
    {
        return Cache::get("{$platform}_{$tenantId}_{$key}");
    }
}
