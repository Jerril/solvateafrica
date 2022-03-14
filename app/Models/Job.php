<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','job_description','title', 'milestone','price_budget','category','job_type','skill', 'creative_id', 'start_date' , 'end_date', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function creative()
    {
        return $this->belongsTo(User::class,'creative_id','id');
    }

     public function job_bids()
    {
        return $this->hasMany(JobUser::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function job_submissions()
    {
        return $this->hasMany(SubmitJob::class, 'job_id');
    }

}