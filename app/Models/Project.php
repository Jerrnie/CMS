<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    //filalble
    protected $fillable = [
        'code',
        'title',
        'description',
        'expertise_detail',
        'unit_id',
        'expertise_id',
    ];

    //relationship
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function expertise()
    {
        return $this->belongsTo(Expertise::class);
    }

    //expertise_fields
    public function expertiseFields()
    {
        return $this->belongsToMany(ExpertiseField::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function tranches()
    {
        return $this->hasMany(Tranch::class);
    }

    public function budgetcode()
    {
        return $this->belongsTo(BudgetCode::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

}
