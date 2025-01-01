<?php

namespace App\Providers;

use App\Contracts\Platform\PlatformAuthService;
use App\Contracts\Platform\PlatformTenantService;
use App\Services\Platform\PlatformApiRateLimiterService;
use InvalidArgumentException;

class PlatformServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PlatformAuthService::class, function ($app, $parameters) {
            $platform = $parameters['platform'] ?? throw new InvalidArgumentException('Platform is required.');
            $authServiceClass = config("platforms.$platform.auth_service");

            if (!class_exists($authServiceClass)) {
                throw new InvalidArgumentException("Auth service class $authServiceClass does not exist.");
            }

            return $app->make($authServiceClass);
        });

        $this->app->bind(PlatformTenantService::class, function ($app, $parameters) {
            $platform = $parameters['platform'] ?? throw new InvalidArgumentException('Platform is required.');
            $platformConfig = config("platforms.$platform");

            if (!$platformConfig || !isset($platformConfig['tenant_service'])) {
                throw new InvalidArgumentException("Unsupported platform: $platform");
            }

            $rateLimiterService = $app->make(PlatformApiRateLimiterService::class);
            $platformTenant = $parameters['platformTenant'] ?? null;

            $tenantServiceClass = $platformConfig['tenant_service'];

            if (!class_exists($tenantServiceClass)) {
                throw new InvalidArgumentException("Tenant service class $tenantServiceClass does not exist.");
            }

            return $app->make($tenantServiceClass, [
                'platformTenant' => $platformTenant,
                'rateLimiterService' => $rateLimiterService,
            ]);
        });

        $this->app->singleton(PlatformApiRateLimiterService::class, function () {
            return new PlatformApiRateLimiterService();
        });
    }
}
