<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullName()
    {
        $fullName = $this->first_name;

        if (!empty($this->middle_name)) {
            // Extract the first character of the middle name
            $middleInitial = substr($this->middle_name, 0, 1);
            $fullName .= ' ' . $middleInitial . '.';
        }

        $fullName .= ' ' . $this->last_name;

        return $fullName;
    }

    public function basicInformation(): HasOne
    {
        return $this->hasOne(BasicInformation::class);
    }

    public function consultantInformation()
    {
        return $this->hasOne(ConsultantInfo::class);
    }

    public function expertiseList()
    {
        return $this->hasMany(Expertise::class);
    }

    public function documentList()
    {
        return $this->hasMany(SupportingDocument::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }
}
