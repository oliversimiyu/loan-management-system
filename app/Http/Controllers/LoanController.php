<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Loan::class);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = $user->loans();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by issued date range
        if ($request->filled('issued_date_from')) {
            $query->where('issued_date', '>=', $request->issued_date_from);
        }

        if ($request->filled('issued_date_to')) {
            $query->where('issued_date', '<=', $request->issued_date_to);
        }

        // Paginate results
        $loans = $query->latest()->paginate(10);

        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Loan::class);
        return view('loans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $this->authorize('create', Loan::class);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $loan = $user->loans()->create($request->validated());

        return redirect()->route('loans.index')
            ->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $this->authorize('view', $loan);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $this->authorize('update', $loan);
        return view('loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $this->authorize('update', $loan);
        
        $loan->update($request->validated());

        return redirect()->route('loans.show', $loan)
            ->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $this->authorize('delete', $loan);
        
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully.');
    }
}
