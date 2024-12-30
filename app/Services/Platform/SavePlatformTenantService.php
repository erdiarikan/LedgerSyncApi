<?php

namespace App\Services\Platform;

use App\DTOs\Platform\PlatformTenantDTO;
use App\Models\PlatformCredential;
use App\Models\PlatformTenant;

class SavePlatformTenantService
{
    public function savePlatformTenant(
        PlatformTenantDTO $platformTenant,
        PlatformCredential $platformCredential
    ): PlatformTenant {
        return PlatformTenant::updateOrCreate(
            [
                'platform_id' => $platformTenant->tenantId,
            ],
            [
                'platform_credential_id' => $platformCredential->id,
                'auth_event_id' => $platformTenant->authEventId,
                'organisation_type' => $platformTenant->tenantType,
                'name' => $platformTenant->tenantName,
                'tenant_created_at' => $platformTenant->tenantCreatedAt,
                'tenant_updated_at' => $platformTenant->tenantUpdatedAt,
            ]
        );
    }
}
