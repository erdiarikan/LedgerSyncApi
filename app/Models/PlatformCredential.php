<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'access_token_expire_at',
        'refresh_token',
        'refresh_token_created_at',
        'refresh_token_expire_at',
        'scope',
    ];

    protected function casts(): array
    {
        return [
            'company_uuid' => 'string',
            'access_token_created_at' => 'timestamp',
            'access_token_expire_at' => 'timestamp',
            'refresh_token_created_at' => 'timestamp',
            'refresh_token_expire_at' => 'timestamp',
        ];
    }
}
