<?php

namespace App\Enums;

enum PlatformsEnum: string
{
    case XERO = 'xero';

    public function getPlatformId(): int
    {
        return match ($this) {
            self::XERO => 1,
        };
    }
}
