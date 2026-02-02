@extends('layouts.loans')

@section('title', 'My Loans')

@section('content')
<div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 2rem; font-weight: 700; color: #1e3a8a; margin: 0;">My Loans</h2>
        <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Manage and track all your loan applications</p>
    </div>
    <a href="{{ route('loans.create') }}" class="btn">➕ Create New Loan</a>
</div>

<div class="filters">
    <form method="GET" action="{{ route('loans.index') }}">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="defaulted" {{ request('status') == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
            </select>
        </div>

        <div class="form-group">
            <label for="issued_date_from">Issued From</label>
            <input type="date" name="issued_date_from" id="issued_date_from" value="{{ request('issued_date_from') }}">
        </div>

        <div class="form-group">
            <label for="issued_date_to">Issued To</label>
            <input type="date" name="issued_date_to" id="issued_date_to" value="{{ request('issued_date_to') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Filter</button>
            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>
</div>

<div class="card">
    @if($loans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Loan Number</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>Interest Rate</th>
                    <th>Term (months)</th>
                    <th>Status</th>
                    <th>Issued Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_number }}</td>
                        <td>{{ $loan->customer_name }}</td>
                        <td>KSh {{ number_format($loan->loan_amount, 2) }}</td>
                        <td>{{ $loan->interest_rate }}%</td>
                        <td>{{ $loan->loan_term }}</td>
                        <td>
                            <span class="badge badge-{{ $loan->status }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td>{{ $loan->issued_date->format('d/m/Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('loans.show', $loan) }}" class="btn btn-secondary" style="padding: 0.5rem 0.75rem; font-size: 0.875rem;">👁️ View</a>
                                <a href="{{ route('loans.edit', $loan) }}" class="btn" style="padding: 0.5rem 0.75rem; font-size: 0.875rem;">✏️ Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination" style="margin-top: 1.5rem;">
            {{ $loans->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 4rem 2rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📋</div>
            <p style="font-size: 1.25rem; color: #6b7280; margin-bottom: 1rem;">No loans found</p>
            <a href="{{ route('loans.create') }}" class="btn">➕ Create your first loan</a>
        </div>
    @endif
</div>
@endsection
