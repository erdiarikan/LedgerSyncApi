<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlatformTenant extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_uuid',
        'platform_id',
        'auth_event_id',
        'tenant_id',
        'tenant_type',
        'tenant_name',
        'tenant_created_at',
        'tenant_updated_at',
    ];

    protected function casts(): array
    {
        return [
            'company_uuid' => 'string',
            'tenant_created_at' => 'timestamp',
            'tenant_updated_at' => 'timestamp',
        ];
    }
}
