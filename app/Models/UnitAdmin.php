<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'admin_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }



}
