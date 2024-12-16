<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformCredential extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_uuid',
        'platform_id',
        'id_token',
        'access_token',
        'access_token_created_at',
        'access_token_expires_at',
        'refresh_token',
        'refresh_token_created_at',
        'refresh_token_expires_at',
        'scope',
    ];

    protected function casts(): array
    {
        return [
            'company_uuid' => 'string',
            'access_token_created_at' => 'timestamp',
            'access_token_expires_at' => 'timestamp',
            'refresh_token_created_at' => 'timestamp',
            'refresh_token_expires_at' => 'timestamp',
        ];
    }

    public function platformTenant(): HasOne
    {
        return $this->hasOne(PlatformTenant::class, 'company_uuid', 'uuid');
    }
}
