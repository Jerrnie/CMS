<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrenchOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'trench_id',
        'title',
        'description',
        'file',
    ];

    public function trench()
    {
        return $this->belongsTo(Trench::class);
    }

}
