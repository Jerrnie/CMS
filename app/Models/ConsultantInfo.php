<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantInfo extends Model
{

    protected $table = 'consultant_info';

    protected $fillable = [
        'years_experience',
        'consulting_category',
        'relatives_at_zff',
        'zff_staff_relative_name',
        'zff_staff_partner',
        'partner_name',
        'partner_position_title',
        'partner_employee_number',
        'zff_staff',
        'position_title',
        'employee_number',
        'employment_end_date',
        'director_or_above',
        'government_employee',
        'gov_employment_end_date',
        'agency_name',
        'country',
        'consulting_assignment_at_zff',
        'found_guilty',
        'guiltyDetails',
    ];

    // protected $casts = [
    //     'employment_end_date' => 'date',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
