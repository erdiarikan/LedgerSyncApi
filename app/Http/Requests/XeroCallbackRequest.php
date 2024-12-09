<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XeroCallbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'state' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The code parameter is required.',
            'code.string' => 'The code parameter must be a string.',
        ];
    }
}
