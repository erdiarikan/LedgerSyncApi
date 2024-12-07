<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FinancialDocumentLineItem extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'financial_document_id',
        'description',
        'unit_amount',
        'tax_type',
        'tax_amount',
        'line_amount',
        'account_code',
        'quantity',
        'discount_rate',
        'external_id',
    ];
}
