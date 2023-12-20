<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'trench_id',
    ];

    public function trench()
    {
        return $this->belongsTo(Trench::class);
    }

    public function deliverables()
    {
        return $this->hasMany(Deliverable::class);
    }

}
