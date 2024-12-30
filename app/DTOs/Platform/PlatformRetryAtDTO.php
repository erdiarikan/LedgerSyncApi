<?php

namespace App\DTOs\Platform;

use Carbon\Carbon;
use InvalidArgumentException;

readonly class PlatformRetryAtDTO
{
    public int $retryAt;

    public function __construct(array $data)
    {
        $this->retryAt = $data['retryAfter'] ?
            Carbon::now()->addSeconds($data['retryAfter']) :
            throw new InvalidArgumentException('retryAfter is required.');
    }
}
