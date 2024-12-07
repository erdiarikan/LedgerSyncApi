<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'paymentable' => ['required'],
            'external_id' => ['nullable'],
            'date' => ['nullable', 'date'],
            'amount' => ['required', 'numeric'],
            'currency_rate' => ['required', 'numeric'],
            'type' => ['required'],
            'status' => ['required'],
            'payment_updated_at' => ['required', 'date'],
            'has_account' => ['boolean'],
            'is_reconciled' => ['boolean'],
            'account_id' => ['nullable', 'integer'],
            'has_validation_error' => ['boolean'],
            'contact_id' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
