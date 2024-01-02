<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_from',
        'date_to',
        'budget',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getTotalBudget($project_id)
    {
        $total_budget = Tranch::where('project_id', $project_id)->sum('budget');
        return $total_budget;
    }
}
