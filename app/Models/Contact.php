<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contact extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'platform_id',
        'status',
        'contact_created_at',
        'contact_updated_at',
        'is_supplier',
        'is_customer',
    ];

    protected function casts(): array
    {
        return [
            'contact_created_at' => 'timestamp',
            'contact_updated_at' => 'timestamp',
            'is_supplier' => 'boolean',
            'is_customer' => 'boolean',
        ];
    }

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }
}
