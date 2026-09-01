<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id', 'user_id', 'filename', 'original_name',
        'file_path', 'file_type', 'file_size', 'description', 'uploaded_by',
    ];

    public function fraudCase()
    {
        return $this->belongsTo(FraudCase::class, 'case_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
