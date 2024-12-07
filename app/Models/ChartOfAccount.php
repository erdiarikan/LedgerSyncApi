<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ChartOfAccount extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'external_id',
        'tenant_id',
        'code',
        'name',
        'status',
        'tax_type',
        'class',
        'system_account',
        'enable_payment_to_account',
        'show_in_expense_claims',
        'bank_account_number',
        'bank_account_type',
        'currency_code',
        'reporting_code',
        'reporting_code_name',
        'has_attachments',
        'chart_of_account_updated_at',
        'add_to_watchlist',
    ];

    protected function casts(): array
    {
        return [
            'enable_payment_to_account' => 'boolean',
            'show_in_expense_claims' => 'boolean',
            'has_attachments' => 'boolean',
            'chart_of_account_updated_at' => 'timestamp',
            'add_to_watchlist' => 'timestamp',
        ];
    }
}
