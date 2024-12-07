<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'addressable' => ['required'],
            'type' => ['required'],
            'address_line_1' => ['required'],
            'address_line_2' => ['nullable'],
            'address_line_3' => ['nullable'],
            'address_line_4' => ['nullable'],
            'address_line_5' => ['nullable'],
            'city' => ['required'],
            'region' => ['nullable'],
            'postcode' => ['required'],
            'country' => ['required'],
            'attention_to' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
