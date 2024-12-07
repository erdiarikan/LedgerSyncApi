<?php

namespace App\Http\Resources;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ChartOfAccount */
class ChartOfAccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'external_id' => $this->external_id,
            'tenant_id' => $this->tenant_id,
            'code' => $this->code,
            'name' => $this->name,
            'status' => $this->status,
            'tax_type' => $this->tax_type,
            'class' => $this->class,
            'system_account' => $this->system_account,
            'enable_payment_to_account' => $this->enable_payment_to_account,
            'show_in_expense_claims' => $this->show_in_expense_claims,
            'bank_account_number' => $this->bank_account_number,
            'bank_account_type' => $this->bank_account_type,
            'currency_code' => $this->currency_code,
            'reporting_code' => $this->reporting_code,
            'reporting_code_name' => $this->reporting_code_name,
            'has_attachments' => $this->has_attachments,
            'chart_of_account_updated_at' => $this->chart_of_account_updated_at,
            'add_to_watchlist' => $this->add_to_watchlist,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
