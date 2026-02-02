<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdateLoanRequest extends FormRequest
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
            'loan_number' => 'sometimes|string|unique:loans,loan_number,' . $this->loan->id . '|max:255',
            'customer_name' => 'sometimes|string|max:255',
            'loan_amount' => 'sometimes|numeric|min:0',
            'interest_rate' => 'sometimes|numeric|min:0|max:100',
            'loan_term' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:pending,approved,active,completed,defaulted',
            'issued_date' => 'sometimes|date',
            'due_date' => 'sometimes|date|after_or_equal:issued_date',
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
            'loan_number.unique' => 'This loan number already exists.',
            'loan_amount.min' => 'The loan amount must be at least 0.',
            'interest_rate.min' => 'The interest rate must be at least 0.',
            'interest_rate.max' => 'The interest rate cannot exceed 100.',
            'loan_term.min' => 'The loan term must be at least 1 month.',
            'status.in' => 'The loan status must be one of: pending, approved, active, completed, defaulted.',
            'due_date.after_or_equal' => 'The due date must be on or after the issued date.',
        ];
    }
}
