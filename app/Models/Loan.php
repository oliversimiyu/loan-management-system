<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'loan_number',
        'customer_name',
        'loan_amount',
        'interest_rate',
        'loan_term',
        'status',
        'issued_date',
        'due_date',
        'user_id',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'loan_term' => 'integer',
        'issued_date' => 'date',
        'due_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
