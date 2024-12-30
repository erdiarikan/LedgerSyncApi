<?php

namespace App\Services\Xero;

use App\DTOs\Platform\PlatformApiResponseDTO;
use App\Enums\PlatformsEnum;
use App\Models\PlatformTenant;
use App\Services\Platform\PlatformApiRateLimiterService;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

readonly class XeroApiClientService
{
    public function __construct(
        private ?PlatformTenant $platformTenant,
        private PlatformApiRateLimiterService $rateLimiterService
    ) {
    }

    public function call(
        string $method,
        string $endpoint,
        array $headers = [],
        array $options = []
    ): PlatformApiResponseDTO {
        $rateLimit = $this->checkRateLimit();
        if ($rateLimit) {
            return new PlatformApiResponseDTO(
                rateLimitExceeded: true,
                retryAt: $rateLimit['retry_at']
            );
        }

        $url = config('platforms.xero.base_url') . $endpoint;

        $response = Http::withHeaders($headers)->$method($url, $options);

        if ($response->status() === 429) {
            $this->handleRateLimitExceeded($response);
            $rateLimit = $this->rateLimiterService->getRateLimit($this->platformTenant);
            return new PlatformApiResponseDTO(
                rateLimitExceeded: true,
                retryAt: $rateLimit['retry_at']
            );
        }

        return new PlatformApiResponseDTO(
            rateLimitExceeded: false,
            retryAt: null,
            data: $response->json()
        );
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
