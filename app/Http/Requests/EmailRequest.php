<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'emailable' => ['required'],
            'address' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
