<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

     protected $fillable = ['user_id','country_id', 'title','from_year','to_year'];

 
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

     public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

}


        