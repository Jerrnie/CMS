<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password']; // Add your actual fillable fields here

    public function role()
    {
        return $this->belongsTo(Role::class); // Assuming an admin belongs to a role
    }

    public function getFullName()
    {
        $fullName = $this->first_name;

        if (!empty($this->middle_name)) {
            // Extract the first character of the middle name
            $middleInitial = substr($this->middle_name, 0, 1);
            $fullName .= ' ' . $middleInitial . '.';
        }

        $fullName .= ' ' . $this->last_name;

        return $fullName;
    }
}
