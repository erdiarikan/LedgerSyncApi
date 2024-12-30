<?php

return [
    'xero' => [
        'base_url' => env('XERO_BASE_URL', 'https://api.xero.com'),
        'auth_service' => App\Adapters\Xero\XeroAuthServiceAdapter::class,
        'tenant_service' => App\Adapters\Xero\XeroTenantServiceAdapter::class,
        'enum' => App\Enums\PlatformsEnum::XERO,
    ],
];
