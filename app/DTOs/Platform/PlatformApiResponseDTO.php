<?php

namespace App\DTOs\Platform;

use Carbon\Carbon;

readonly class PlatformApiResponseDTO
{
    public function __construct(
        public bool $rateLimitExceeded,
        public ?Carbon $retryAt,
        public mixed $data = null
    ) {
    }

    public function isRateLimitExceeded(): bool
    {
        return $this->rateLimitExceeded;
    }
}
