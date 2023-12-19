<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *d
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
        /**
     * Get the budget codes for the unit.
     */
    public function budgetCodes()
    {
        return $this->hasMany(BudgetCode::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
