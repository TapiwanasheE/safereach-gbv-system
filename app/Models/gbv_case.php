<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gbv_case extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_number',
        'description',
        'date_reported',
        'location',
        'status',
        'user_id',
        'type',
        'stage',
        'assigned_staff_id',
        'anonymous',
        'medical_review',
        'medical_findings',
        'counseling_notes',
        'counseling_sessions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_staff_id', 'id');
    }

    public function caseHistories()
    {
        return $this->hasMany(case_historie::class, 'case_id');
    }

}
