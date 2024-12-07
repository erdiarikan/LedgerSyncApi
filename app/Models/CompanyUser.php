<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CompanyUser extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_uuid',
        'user_id',
        'role',
    ];

    protected function casts(): array
    {
        return [
            'company_id' => 'string',
            'user_iid' => 'string',
        ];
    }
}
