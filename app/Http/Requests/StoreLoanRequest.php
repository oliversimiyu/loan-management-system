<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert DD/MM/YYYY to Y-m-d format for database
        if ($this->issued_date) {
            $this->merge([
                'issued_date' => $this->convertDateFormat($this->issued_date),
            ]);
        }
        
        if ($this->due_date) {
            $this->merge([
                'due_date' => $this->convertDateFormat($this->due_date),
            ]);
        }
    }

    /**
     * Convert DD/MM/YYYY to Y-m-d
     */
    private function convertDateFormat($date)
    {
        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return $date; // Return as is if format is invalid
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loan_number' => 'required|string|unique:loans,loan_number|max:255',
            'customer_name' => 'required|string|max:255',
            'loan_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'loan_term' => 'required|integer|min:1',
            'status' => 'required|in:pending,approved,active,completed,defaulted',
            'issued_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issued_date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'loan_number.required' => 'The loan number is required.',
            'loan_number.unique' => 'This loan number already exists.',
            'customer_name.required' => 'The customer name is required.',
            'loan_amount.required' => 'The loan amount is required.',
            'loan_amount.min' => 'The loan amount must be at least 0.',
            'interest_rate.required' => 'The interest rate is required.',
            'interest_rate.min' => 'The interest rate must be at least 0.',
            'interest_rate.max' => 'The interest rate cannot exceed 100.',
            'loan_term.required' => 'The loan term is required.',
            'loan_term.min' => 'The loan term must be at least 1 month.',
            'status.required' => 'The loan status is required.',
            'status.in' => 'The loan status must be one of: pending, approved, active, completed, defaulted.',
            'issued_date.required' => 'The issued date is required.',
            'due_date.required' => 'The due date is required.',
            'due_date.after_or_equal' => 'The due date must be on or after the issued date.',
        ];
    }
}
