<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\PlatformsEnum;

class ResolvePlatformMiddleware
{
    public function handle(Request $request, Closure $next, string $platform)
    {
        $platformEnum = match ($platform) {
            'xero' => PlatformsEnum::XERO->value,
            default => null,
        };

        if (!$platformEnum) {
            abort(400, 'Platform could not be determined.');
        }

        $request->merge(['platform' => $platformEnum]);

        return $next($request);
    }
}
