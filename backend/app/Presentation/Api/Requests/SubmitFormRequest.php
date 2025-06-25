<?php

namespace App\Presentation\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Add your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'values' => 'required|array',
            'values.*' => 'nullable', // Allow any type of value for form fields
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'values.required' => 'Form values are required',
            'values.array' => 'Form values must be an array',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'values' => 'form values',
        ];
    }
}