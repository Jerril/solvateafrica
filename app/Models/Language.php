<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name','iso2','iso3'];

     /**
     * The users that belong to the skill.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'language_user')->withPivot('proficiency');
    }
}
