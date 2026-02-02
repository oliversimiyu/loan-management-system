@extends('layouts.loans')

@section('title', 'Loan Details')

@section('content')
<div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 2rem; font-weight: 700; color: #1e3a8a; margin: 0;">Loan Details</h2>
        <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Complete information about this loan</p>
    </div>
    <div style="display: flex; gap: 0.75rem;">
        <a href="{{ route('loans.edit', $loan) }}" class="btn">✏️ Edit</a>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">← Back to Loans</a>
    </div>
</div>

<div class="card">
    <div class="detail-row">
        <span class="detail-label">Loan Number:</span>
        <span class="detail-value">{{ $loan->loan_number }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Customer Name:</span>
        <span class="detail-value">{{ $loan->customer_name }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Loan Amount:</span>
        <span class="detail-value">KSh {{ number_format($loan->loan_amount, 2) }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Interest Rate:</span>
        <span class="detail-value">{{ $loan->interest_rate }}%</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Loan Term:</span>
        <span class="detail-value">{{ $loan->loan_term }} months</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Status:</span>
        <span class="badge badge-{{ $loan->status }}">
            {{ ucfirst($loan->status) }}
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Issued Date:</span>
        <span class="detail-value">{{ $loan->issued_date->format('d/m/Y') }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Due Date:</span>
        <span class="detail-value">{{ $loan->due_date->format('d/m/Y') }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Created At:</span>
        <span class="detail-value">{{ $loan->created_at->format('d/m/Y h:i A') }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Last Updated:</span>
        <span class="detail-value">{{ $loan->updated_at->format('d/m/Y h:i A') }}</span>
    </div>

    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #f3f4f6;">
        <form method="POST" action="{{ route('loans.destroy', $loan) }}" onsubmit="return confirm('Are you sure you want to delete this loan? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Delete Loan</button>
        </form>
    </div>
</div>
@endsection
