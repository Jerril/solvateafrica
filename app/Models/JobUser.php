<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','job_id','accept_price', 'price_to_accept', 'pitch'];

     public function user()
    {
        return $this->BelongsTo(\App\Models\User::class, 'user_id','id');
    }

      public function job()
    {
        return $this->BelongsTo(\App\Models\Job::class, 'job_id','id');
    }
}