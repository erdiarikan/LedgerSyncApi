<?php

namespace App\Providers;

use App\Adapters\Xero\XeroAuthServiceAdapter;
use App\Adapters\Xero\XeroTenantServiceAdapter;
use App\Services\Platform\PlatformApiRateLimiterService;
use App\Services\Xero\XeroApiClientService;
use App\Services\Xero\XeroAuthService;
use App\Services\Xero\XeroTenantService;

class XeroServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
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
}
