<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expertise_field_id',
        'detail',
        'is_primary',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the ExpertiseField model
    public function expertiseField()
    {
        return $this->belongsTo(ExpertiseField::class);
    }
}
