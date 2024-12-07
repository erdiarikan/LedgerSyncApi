<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialDocumentLineItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'financial_document_id' => ['required', 'integer'],
            'description' => ['nullable'],
            'unit_amount' => ['nullable', 'numeric'],
            'tax_type' => ['nullable'],
            'tax_amount' => ['nullable', 'numeric'],
            'line_amount' => ['nullable', 'numeric'],
            'account_code' => ['nullable'],
            'quantity' => ['nullable', 'numeric'],
            'discount_rate' => ['nullable', 'numeric'],
            'line_item_id' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
