<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Payment */
class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'paymentable' => $this->paymentable,
            'external_id' => $this->external_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'currency_rate' => $this->currency_rate,
            'type' => $this->type,
            'status' => $this->status,
            'payment_updated_at' => $this->payment_updated_at,
            'has_account' => $this->has_account,
            'is_reconciled' => $this->is_reconciled,
            'account_id' => $this->account_id,
            'has_validation_error' => $this->has_validation_error,
            'contact_id' => $this->contact_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
