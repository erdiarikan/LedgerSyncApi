<?php

namespace App\DTOs;

use Carbon\Carbon;
use InvalidArgumentException;

class PlatformTenantDTO
{
    public ?string $authEventId;
    public string $tenantId;
    public ?string $tenantType;
    public string $tenantName;
    public ?Carbon $tenantCreatedAt;
    public ?Carbon $tenantUpdatedAt;

    public ?string $scope;


    public function __construct(array $data)
    {
        $this->authEventId = $data['authEventId'] ?? null;
        $this->tenantId = $data['tenantId'] ?? throw new InvalidArgumentException('tenantId is required.');
        $this->tenantType = $data['tenantType'] ?? null;
        $this->tenantName = $data['tenantName'] ?? throw new InvalidArgumentException('tenantName is required.');
        $this->tenantCreatedAt = $data['createdDateUtc'] ? Carbon::parse($data['createdDateUtc']) : null;
        $this->tenantUpdatedAt = $data['updatedDateUtc'] ? Carbon::parse($data['updatedDateUtc']) : null;
    }
}
