<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable=[
        'logo',
        'HomePageBanner',
        'opportunitiesBanner',
        'applicationsBanner',
        'projectsBanner',
        'aboutUsBanner',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function quarter()
    {
        return $this->belongsTo(Quarter::class);
    }


}
