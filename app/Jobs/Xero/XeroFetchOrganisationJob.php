<?php

namespace App\Jobs\Xero;

use App\Models\PlatformTenant;
use App\Traits\CachesPlatformApiRateLimits;
use Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class XeroFetchOrganisationJob implements ShouldQueue
{
    use Queueable, CachesPlatformApiRateLimits;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly PlatformTenant $platformTenant
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $checkRateLimits = $this->checkRateLimits(
            $this->platformTenant,
            $this->platformTenant->platform->rateLimit
        );
        $remainingCallLimit = Cache::remember(
            $this->platformTenant->id . '_xero_remaining_call_limit',
            now()->addDay(),
            function () {
                return config('xero.max_calls_per_day');
            }
        );

        if ($remainingCallLimit <= 0) {
            return;
        }
    }
}
