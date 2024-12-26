<?php

namespace App\Services\Platform;

use App\Enums\CacheKeySuffixesEnum;
use App\Models\PlatformTenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

readonly class PlatformApiRateLimiterService
{
    public function cacheRateLimits(PlatformTenant $platformTenant, Carbon $retryAfter): void
    {
        $retryAt = $retryAfter->copy()->addSeconds(config('platform.retry_after_buffer'));

        $this->putCache(
            $this->getCacheKey($platformTenant, CacheKeySuffixesEnum::RATE_LIMIT_EXCEEDED->value),
            true,
            $retryAt
        );
        $this->putCache(
            $this->getCacheKey($platformTenant, CacheKeySuffixesEnum::RETRY_AT->value),
            $retryAt,
            $retryAt
        );
    }

    public function getRateLimit(PlatformTenant $platformTenant): ?array
    {
        if (!Cache::has($this->getCacheKey($platformTenant, CacheKeySuffixesEnum::RATE_LIMIT_EXCEEDED->value))) {
            return null;
        }

        return [
            'rate_limit_exceeded' => true,
            'retry_at' => Cache::get($this->getCacheKey($platformTenant, CacheKeySuffixesEnum::RETRY_AT->value)),
        ];
    }

    private function putCache(string $cacheKey, mixed $value, Carbon $ttl): void
    {
        Cache::put(
            $cacheKey,
            $value,
            $ttl
        );
    }

    private function getCacheKey(PlatformTenant $platformTenant, string $suffix): string
    {
        return "{$platformTenant->platform_id}_$suffix";
    }
}
