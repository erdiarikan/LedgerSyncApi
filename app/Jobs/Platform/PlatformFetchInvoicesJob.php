<?php

namespace App\Jobs\Platform;

use App\Models\PlatformTenant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PlatformFetchInvoicesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private PlatformTenant $platformTenant
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    }
}
