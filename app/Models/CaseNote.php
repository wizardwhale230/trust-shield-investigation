<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id', 'author_id', 'author_type', 'note', 'is_internal',
    ];

    protected $casts = [
        'is_internal' => 'boolean',
    ];

    public function fraudCase()
    {
        return $this->belongsTo(FraudCase::class, 'case_id');
    }

    public function author()
    {
        return $this->morphTo();
    }
}
