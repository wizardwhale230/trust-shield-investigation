<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id', 'user_id', 'requested_by', 'title',
        'description', 'amount', 'status', 'paid_at', 'deposit_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function fraudCase()
    {
        return $this->belongsTo(FraudCase::class, 'case_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(Admin::class, 'requested_by');
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
