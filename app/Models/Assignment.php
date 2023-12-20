<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'project_id',
        'consultant_id',
        'requestor_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function consultant()
    {
        return $this->belongsTo(User::class);
    }

    public function requestor()
    {
        return $this->belongsTo(Admin::class);
    }


}
