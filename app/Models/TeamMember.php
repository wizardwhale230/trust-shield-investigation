<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';

    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'photo',
        'bio',
        'email',
        'phone',
        'years_experience',
        'specialization',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'years_experience' => 'integer',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        // Initials-based placeholder via UI Avatars
        $initials = urlencode(strtoupper(substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1)));
        return 'https://ui-avatars.com/api/?name=' . $initials . '&background=0A1F44&color=B08D57&size=128';
    }

    public function fraudCases()
    {
        return $this->hasMany(FraudCase::class, 'team_member_id');
    }
}
