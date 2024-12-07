<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'external_id',
        'date',
        'amount',
        'currency_rate',
        'type',
        'status',
        'payment_updated_at',
        'has_account',
        'is_reconciled',
        'account_id',
        'has_validation_error',
        'contact_id',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'timestamp',
            'payment_updated_at' => 'timestamp',
            'has_account' => 'boolean',
            'is_reconciled' => 'boolean',
            'has_validation_error' => 'boolean',
        ];
    }

    public function paymentable(): MorphTo
    {
        return $this->morphTo();
    }
}
