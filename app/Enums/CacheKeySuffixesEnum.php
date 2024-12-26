<?php

namespace App\Enums;

enum CacheKeySuffixesEnum: string
{
    case RATE_LIMIT_EXCEEDED = 'rate_limit_exceeded';
    case RETRY_AT = 'retry_at';
}
