<?php

namespace App\Providers;

use App\Adapters\Xero\XeroAuthServiceAdapter;
use App\Adapters\Xero\XeroTenantServiceAdapter;
use App\Contracts\Platform\PlatformAuthService;
use App\Contracts\Platform\PlatformTenantService;
use App\Services\Platform\PlatformApiRateLimiterService;
use App\Services\Xero\XeroApiClientService;
use App\Services\Xero\XeroAuthService;
use App\Services\Xero\XeroTenantService;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
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

        $this->app->singleton(XeroApiClientService::class, function ($app, $parameters) {
            $platformTenant = $parameters['platformTenant'] ?? null;

            return new XeroApiClientService(
                $platformTenant,
                $app->make(PlatformApiRateLimiterService::class)
            );
        });

        $this->app->singleton(XeroAuthServiceAdapter::class, function () {
            return new XeroAuthServiceAdapter(new XeroAuthService());
        });

        $this->app->singleton(XeroTenantServiceAdapter::class, function ($app, $parameters) {
            $platformTenant = $parameters['platformTenant'] ?? null;

            return $app->make(XeroTenantService::class, [
                'xeroApiClientService' => $app->make(XeroApiClientService::class, [
                    'platformTenant' => $platformTenant,
                ]),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
