<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'signup_channel'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function workprofiles()
    {
        return $this->hasMany(WorkProfile::class);
    }

     public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * The skills that belong to the user.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user')->withPivot('proficiency')->withTimestamps();
    }

     /**
     * The languages that belong to the user.
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_user')->withPivot('proficiency')->withTimestamps();
    }

     public function userdetail()
    {
        return $this->hasOne(UserDetail::class, 'userId');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function sent_reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function received_reviewes()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }
}
