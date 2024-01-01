<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tranch_id',
    ];

    public function tranch()
    {
        return $this->belongsTo(Tranch::class);
    }

    public function deliverables()
    {
        return $this->hasMany(Deliverable::class);
    }

}
