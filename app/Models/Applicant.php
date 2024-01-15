<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the applicant.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the project that owns the applicant.
     */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * fillables
     **/
    protected $fillable = [
        'user_id',
        'project_id',
        'application_date',
    ];

    /**
     * casts
     **/


}
