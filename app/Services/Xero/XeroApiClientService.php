<?php

namespace App\Services\Xero;

use App\Enums\PlatformsEnum;
use App\Models\PlatformTenant;
use App\Services\Platform\PlatformApiRateLimiterService;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use PlatformApiResponseDTO;

class XeroApiClientService
{
    public function __construct(
        protected Http $apiClient,
        private readonly PlatformTenant $platformTenant,
        private readonly PlatformApiRateLimiterService $rateLimiterService
    ) {
    }

    public function call(string $method, string $endpoint, array $options = []): PlatformApiResponseDTO
    {
        $rateLimit = $this->checkRateLimit();
        if ($rateLimit) {
            return new PlatformApiResponseDTO(
                rateLimitExceeded: true,
                retryAt: $rateLimit['retry_at']
            );
        }

        $url = PlatformsEnum::XERO->apiBaseUrl() . $endpoint;

        $response = $this->apiClient->$method($url, $options);

        if ($response->status() === 429) {
            $this->handleRateLimitExceeded($response);
            $rateLimit = $this->rateLimiterService->getRateLimit($this->platformTenant);
            return new PlatformApiResponseDTO(
                rateLimitExceeded: true,
                retryAt: $rateLimit['retry_at']
            );
        }

        return $response;
    }

    private function checkRateLimit(): ?array
    {
        return $this->rateLimiterService->getRateLimit($this->platformTenant);
    }

    private function handleRateLimitExceeded(Response $response): void
    {
        $retryAfter = (int) $response->header('Retry-After');
        $this->rateLimiterService->cacheRateLimits(
            $this->platformTenant,
            Carbon::now()->addSeconds($retryAfter)
        );
    }
}
