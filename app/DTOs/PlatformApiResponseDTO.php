<?php

use Carbon\Carbon;

class PlatformApiResponseDTO
{
    public function __construct(
        public readonly bool $rateLimitExceeded,
        public readonly ?Carbon $retryAt,
        public readonly mixed $data = null
    ) {
    }

    public function isRateLimitExceeded(): bool
    {
        return $this->rateLimitExceeded;
    }
}
