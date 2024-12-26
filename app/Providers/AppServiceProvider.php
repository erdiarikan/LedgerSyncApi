<?php

namespace App\Providers;

use App\Adapters\Xero\XeroAuthServiceAdapter;
use App\Adapters\Xero\XeroTenantServiceAdapter;
use App\Contracts\Platform\PlatformAuthService;
use App\Contracts\Platform\PlatformTenantService;
use App\Services\Xero\XeroAuthService;
use App\Services\Xero\XeroTenantService;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PlatformAuthService::class, function () {
            return new XeroAuthServiceAdapter(new XeroAuthService());
        });
        $this->app->bind(PlatformTenantService::class, function () {
            return new XeroTenantServiceAdapter(new XeroTenantService());
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
