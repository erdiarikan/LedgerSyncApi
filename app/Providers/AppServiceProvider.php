<?php

namespace App\Providers;

use App\Adapters\Xero\XeroAuthServiceAdapter;
use App\Adapters\Xero\XeroTenantServiceAdapter;
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
        //
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
