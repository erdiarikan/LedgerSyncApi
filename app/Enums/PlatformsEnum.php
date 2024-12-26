<?php

namespace App\Enums;

enum PlatformsEnum: int
{
    case XERO = 1;

    public function apiBaseUrl(): string
    {
        return match ($this->value) {
            self::XERO->value => config('xero.api_base_url'),
        };
    }
}
