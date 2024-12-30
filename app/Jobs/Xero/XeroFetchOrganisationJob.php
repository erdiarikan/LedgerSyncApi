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

    }
}
