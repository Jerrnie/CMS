<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // Add other fillable fields here if necessary
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class); // Assuming an admin belongs to a role
    }
}
