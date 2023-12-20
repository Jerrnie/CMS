<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'activity_id',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

}
