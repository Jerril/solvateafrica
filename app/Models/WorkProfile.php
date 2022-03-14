<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProfile extends Model
{
    use HasFactory;

     protected $fillable = ['title','description', 'company','from_month','from_year','to_month','to_year','user_id','currently_working'];

/*    protected static function boot()
    {
    	//TODO
    /*	  self::creating(function ($workProfile) {
            User::where('id', $workProfile->user_id)->increment('work_profile_count');
        });
        self::deleting(function ($workProfile) {
            User::where('id', $workProfile->user_id)->decrement('work_profile_count');
        }); 
    }*/
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}