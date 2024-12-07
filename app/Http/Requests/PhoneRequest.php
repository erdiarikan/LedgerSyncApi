<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phoneable' => ['required'],
            'type' => ['nullable'],
            'number' => ['required'],
            'area_code' => ['nullable'],
            'country_code' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
