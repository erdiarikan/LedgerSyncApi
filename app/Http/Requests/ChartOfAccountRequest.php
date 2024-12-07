<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChartOfAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'external_id' => ['required'],
            'tenant_id' => ['required', 'integer'],
            'code' => ['nullable'],
            'name' => ['nullable'],
            'status' => ['nullable'],
            'tax_type' => ['nullable'],
            'class' => ['nullable'],
            'system_account' => ['nullable'],
            'enable_payment_to_account' => ['nullable', 'boolean'],
            'show_in_expense_claims' => ['nullable', 'boolean'],
            'bank_account_number' => ['nullable'],
            'bank_account_type' => ['nullable'],
            'currency_code' => ['nullable'],
            'reporting_code' => ['nullable'],
            'reporting_code_name' => ['nullable'],
            'has_attachments' => ['nullable', 'boolean'],
            'chart_of_account_updated_at' => ['nullable', 'date'],
            'add_to_watchlist' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
