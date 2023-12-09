<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_birth',
        'sex',
        'country',
        'citizenship',
        'gov_id_type',
        'gov_id_number',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
