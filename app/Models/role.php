<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship: A role has many users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
