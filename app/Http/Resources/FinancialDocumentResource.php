<?php

namespace App\Http\Resources;

use App\Models\FinancialDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FinancialDocument */
class FinancialDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'documentable' => $this->documentable,
            'type' => $this->type,
            'contact_id' => $this->contact_id,
            'external_id' => $this->external_id,
            'tenant_id' => $this->tenant_id,
            'document_number' => $this->document_number,
            'reference' => $this->reference,
            'amount_due' => $this->amount_due,
            'amount_paid' => $this->amount_paid,
            'amount_credited' => $this->amount_credited,
            'currency_rate' => $this->currency_rate,
            'is_discounted' => $this->is_discounted,
            'has_attachments' => $this->has_attachments,
            'has_errors' => $this->has_errors,
            'date' => $this->date,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'line_amount_types' => $this->line_amount_types,
            'sub_total' => $this->sub_total,
            'total_tax' => $this->total_tax,
            'total' => $this->total,
            'document_updated_at' => $this->document_updated_at,
            'currency_code' => $this->currency_code,
            'branding_theme_id' => $this->branding_theme_id,
            'fully_paid_on_at' => $this->fully_paid_on_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
