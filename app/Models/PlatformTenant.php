<?php

namespace App\Models;

use A\B;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlatformTenant extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'platform_credential_id',
        'company_uuid',
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

    public function platformCredential(): BelongsTo
    {
        return $this->belongsTo(PlatformCredential::class, 'company_uuid', 'uuid');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_platform_tenant', 'platform_tenant_id', 'company_uuid')
            ->withTimestamps();
    }

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
