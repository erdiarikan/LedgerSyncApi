<?php

namespace App\Services\Platform;

use App\DTOs\PlatformAccessTokenDTO;
use App\DTOs\PlatformTenantDTO;
use App\Enums\PlatformsEnum;
use App\Models\PlatformCredential;
use App\Models\PlatformTenant;
use Carbon\Carbon;

class SavePlatformTenantService
{
    public function savePlatformTenant(
        PlatformTenantDTO $platformTenant,
        PlatformCredential $platformCredential
    ): PlatformTenant {
        return PlatformTenant::updateOrCreate(
            [
                'tenant_id' => $platformTenant->tenantId,
            ],
            [
                'platform_credential_id' => $platformCredential->id,
                'auth_event_id' => $platformTenant->authEventId,
                'tenant_type' => $platformTenant->tenantType,
                'tenant_name' => $platformTenant->tenantName,
                'tenant_created_at' => $platformTenant->tenantCreatedAt,
                'tenant_updated_at' => $platformTenant->tenantUpdatedAt,
            ]
        );
    }
}
