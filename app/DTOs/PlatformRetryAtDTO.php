<?php

namespace App\DTOs;

use Carbon\Carbon;
use InvalidArgumentException;

class PlatformRetryAtDTO
{
    public int $retryAt;

    public function __construct(array $data)
    {
        $this->retryAt = $data['retryAfter'] ?
            Carbon::now()->addSeconds($data['retryAfter']) :
            throw new InvalidArgumentException('retryAfter is required.');
    }
}
