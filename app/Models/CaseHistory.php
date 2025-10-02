<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'updated_by',
        'status',
        'from_stage',
        'to_stage',
        'action_type',
        'action_description'
    ];

    // Relationships
    public function case()
    {
        return $this->belongsTo(gbv_case::class, 'case_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
