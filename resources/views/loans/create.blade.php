@extends('layouts.loans')

@section('title', 'Create Loan')

@section('content')
<div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 2rem; font-weight: 700; color: #1e3a8a; margin: 0;">Create New Loan</h2>
        <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Fill in the form below to create a new loan application</p>
    </div>
    <a href="{{ route('loans.index') }}" class="btn btn-secondary">← Back to Loans</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <div class="form-group">
            <label for="loan_number">Loan Number *</label>
            <input type="text" name="loan_number" id="loan_number" value="{{ old('loan_number') }}" required>
            @error('loan_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="customer_name">Customer Name *</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_amount">Loan Amount *</label>
            <input type="number" name="loan_amount" id="loan_amount" step="0.01" value="{{ old('loan_amount') }}" required>
            @error('loan_amount')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="interest_rate">Interest Rate (%) *</label>
            <input type="number" name="interest_rate" id="interest_rate" step="0.01" value="{{ old('interest_rate') }}" required>
            @error('interest_rate')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_term">Loan Term (months) *</label>
            <input type="number" name="loan_term" id="loan_term" value="{{ old('loan_term') }}" required>
            @error('loan_term')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" required>
                <option value="">Select Status</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="defaulted" {{ old('status') == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="issued_date">Issued Date *</label>
            <input type="text" name="issued_date" id="issued_date" value="{{ old('issued_date') }}" placeholder="DD/MM/YYYY" required pattern="\d{2}/\d{2}/\d{4}">
            <input type="hidden" name="issued_date_raw" id="issued_date_raw">
            @error('issued_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="due_date">Due Date * <span style="color: #6b7280; font-weight: normal; font-size: 0.875rem;">(Auto-calculated)</span></label>
            <input type="text" name="due_date" id="due_date" value="{{ old('due_date') }}" placeholder="DD/MM/YYYY" required readonly style="background-color: #f3f4f6; cursor: not-allowed;">
            <input type="hidden" name="due_date_raw" id="due_date_raw">
            @error('due_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 1.5rem;">
            <button type="submit" class="btn">Create Loan</button>
            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Format date as DD/MM/YYYY
    function formatDateDMY(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
    
    // Parse DD/MM/YYYY to Date object
    function parseDateDMY(dateStr) {
        if (!dateStr) return null;
        const parts = dateStr.split('/');
        if (parts.length !== 3) return null;
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }
    
    // Auto-calculate due date based on issued date and loan term
    function calculateDueDate() {
        const issuedDateStr = document.getElementById('issued_date').value;
        const loanTerm = document.getElementById('loan_term').value;
        
        if (issuedDateStr && loanTerm) {
            const issued = parseDateDMY(issuedDateStr);
            if (issued) {
                const dueDate = new Date(issued);
                dueDate.setMonth(dueDate.getMonth() + parseInt(loanTerm));
                document.getElementById('due_date').value = formatDateDMY(dueDate);
            }
        }
    }
    
    // Add event listeners
    document.getElementById('issued_date').addEventListener('blur', calculateDueDate);
    document.getElementById('loan_term').addEventListener('input', calculateDueDate);
    
    // Set today's date as default
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('issued_date').value) {
            document.getElementById('issued_date').value = formatDateDMY(new Date());
        }
        calculateDueDate();
    });
</script>
@endsection
