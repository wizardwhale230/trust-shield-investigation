<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',
        'priority',
        'ticket_number',
        'last_replied_at',
        'closed_at',
    ];

    protected $casts = [
        'last_replied_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public static function generateTicketNumber()
    {
        do {
            $number = 'TKT-' . strtoupper(Str::random(8));
        } while (static::where('ticket_number', $number)->exists());

        return $number;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function latestReply()
    {
        return $this->hasOne(TicketReply::class)->latestOfMany();
    }

    public function getStatusLabelAttribute()
    {
        return [
            'open' => 'Open',
            'answered' => 'Answered',
            'closed' => 'Closed',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'open' => 'warning',
            'answered' => 'success',
            'closed' => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function getPriorityColorAttribute()
    {
        return [
            'low' => 'text-content-tertiary',
            'medium' => 'text-primary',
            'high' => 'text-warning',
            'urgent' => 'text-danger',
        ][$this->priority] ?? 'text-content-tertiary';
    }
}
