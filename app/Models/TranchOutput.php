<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranchOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'tranch_id',
        'title',
        'description',
        'file',
    ];

    public function tranch()
    {
        return $this->belongsTo(Tranch::class);
    }

}
