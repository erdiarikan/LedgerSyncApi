<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'contactable' => ['required'],
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['nullable'],
            'status' => ['required'],
            'contact_created_at' => ['nullable', 'date'],
            'contact_updated_at' => ['nullable', 'date'],
            'is_supplier' => ['boolean'],
            'is_customer' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
