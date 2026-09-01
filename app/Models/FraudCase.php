<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudCase extends Model
{
    use HasFactory;

    protected $table = 'fraud_cases';

    protected $fillable = [
        'case_number', 'user_id', 'team_member_id', 'status', 'fraud_type',
        'amount_lost', 'timeframe', 'description', 'amount_recovered',
        'priority', 'closed_at',
    ];

    protected $casts = [
        'amount_recovered' => 'float',
        'closed_at' => 'datetime',
    ];

    /**
     * Return amount_lost as a float, parsing range labels like "£5,000 - £25,000"
     * (takes the lower-bound value) as well as plain numeric strings.
     */
    public function getAmountLostAttribute($value): float
    {
        if (is_numeric($value)) {
            return (float) $value;
        }
        // Strip currency symbols and commas, extract the first number
        if (preg_match('/[\d,]+/', str_replace(['£', '$', '€', ' '], '', (string) $value), $matches)) {
            return (float) str_replace(',', '', $matches[0]);
        }
        return 0.0;
    }

    /**
     * The raw label stored (e.g. "£5,000 - £25,000") — used where you want
     * to display the original range text rather than a formatted number.
     */
    public function getAmountLostLabelAttribute(): string
    {
        return $this->attributes['amount_lost'] ?? '';
    }

    public static function generateCaseNumber()
    {
        // Random, non-sequential, no year/index leakage so users cannot
        // infer total case volume or filing order. Format: REC-XXXXXXXX
        // (8-char uppercase alphanumeric, ambiguous chars removed).
        do {
            $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // no 0/O/1/I
            $code = '';
            for ($i = 0; $i < 8; $i++) {
                $code .= $alphabet[random_int(0, strlen($alphabet) - 1)];
            }
            $candidate = 'REC-' . $code;
        } while (static::where('case_number', $candidate)->exists());

        return $candidate;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id');
    }

    public function documents()
    {
        return $this->hasMany(CaseDocument::class, 'case_id');
    }

    public function notes()
    {
        return $this->hasMany(CaseNote::class, 'case_id');
    }

    public function visibleNotes()
    {
        return $this->hasMany(CaseNote::class, 'case_id')->where('is_internal', false);
    }

    public function feeRequests()
    {
        return $this->hasMany(FeeRequest::class, 'case_id');
    }

    public function getStatusLabelAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'new' => 'info',
            'assigned' => 'primary',
            'investigating' => 'warning',
            'legal_action' => 'warning',
            'funds_recovered' => 'success',
            'withdrawal_ready' => 'success',
            'closed' => 'muted',
            default => 'muted',
        };
    }
}
