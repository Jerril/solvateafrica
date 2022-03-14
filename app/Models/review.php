<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['reviewer_id', 'reviewee_id', 'job_id', 'rating', 'recommend_user', 'comment'];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');   
    }

    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id');   
    }

    public function job()
    {
        return $this->belongsTo(Job::class);   
    }
}
