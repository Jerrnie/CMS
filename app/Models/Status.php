<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    // addfilaable

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
