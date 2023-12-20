<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trench extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_date',
        'to_date',
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
}
