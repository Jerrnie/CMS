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

    public function getProgressPercentage($project_id)
    {
        $total_activities = Activity::where('project_id', $project_id)->count();

        $total_activities_completed = Activity::where('project_id', $project_id)
                                          ->where('status_id', 3)
                                          ->count();

        if ($total_activities == 0) {
            $progress_percentage = 0;
        } else {
            $progress_percentage = ($total_activities_completed / $total_activities) * 100;
        }

        return $progress_percentage;
    }
}
