<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory;

    public $fillable = ['firstname','lastname','gender','phone_number','address','countryId','stateId','cityId', 'userId','profile_image','storyline','description'];

    use SoftDeletes;

    public function user()
    {
        return $this->BelongsTo('App\Models\User', 'userId','id');
    }
}
