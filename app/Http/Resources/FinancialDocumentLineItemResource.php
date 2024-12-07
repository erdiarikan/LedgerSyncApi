<?php

namespace App\Http\Resources;

use App\Models\FinancialDocumentLineItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FinancialDocumentLineItem */
class FinancialDocumentLineItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'financial_document_id' => $this->financial_document_id,
            'description' => $this->description,
            'unit_amount' => $this->unit_amount,
            'tax_type' => $this->tax_type,
            'tax_amount' => $this->tax_amount,
            'line_amount' => $this->line_amount,
            'account_code' => $this->account_code,
            'quantity' => $this->quantity,
            'discount_rate' => $this->discount_rate,
            'line_item_id' => $this->line_item_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
