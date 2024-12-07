<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'documentable' => ['required'],
            'type' => ['required'],
            'contact_id' => ['required', 'integer'],
            'external_id' => ['required'],
            'tenant_id' => ['nullable', 'integer'],
            'document_number' => ['nullable'],
            'reference' => ['nullable'],
            'amount_due' => ['nullable', 'numeric'],
            'amount_paid' => ['nullable', 'numeric'],
            'amount_credited' => ['nullable', 'numeric'],
            'currency_rate' => ['nullable', 'numeric'],
            'is_discounted' => ['boolean'],
            'has_attachments' => ['boolean'],
            'has_errors' => ['boolean'],
            'date' => ['required', 'date'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required'],
            'line_amount_types' => ['required'],
            'sub_total' => ['required', 'numeric'],
            'total_tax' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'document_updated_at' => ['required', 'date'],
            'currency_code' => ['nullable'],
            'branding_theme_id' => ['nullable'],
            'fully_paid_on_at' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
