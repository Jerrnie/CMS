<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'unit_activity',
        'budget',
        'unit_id',
        'quarter_id',
    ];
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function quarter()
    {
        return $this->belongsTo(Quarter::class);
    }
}
