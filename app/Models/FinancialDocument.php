<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FinancialDocument extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'type',
        'contact_id',
        'external_id',
        'tenant_id',
        'document_number',
        'reference',
        'amount_due',
        'amount_paid',
        'amount_credited',
        'currency_rate',
        'is_discounted',
        'has_attachments',
        'has_errors',
        'date',
        'due_date',
        'status',
        'line_amount_types',
        'sub_total',
        'total_tax',
        'total',
        'document_updated_at',
        'currency_code',
        'branding_theme_id',
        'fully_paid_on_at',
    ];

    protected function casts(): array
    {
        return [
            'is_discounted' => 'boolean',
            'has_attachments' => 'boolean',
            'has_errors' => 'boolean',
            'date' => 'timestamp',
            'due_date' => 'timestamp',
            'document_updated_at' => 'timestamp',
            'fully_paid_on_at' => 'timestamp',
        ];
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
