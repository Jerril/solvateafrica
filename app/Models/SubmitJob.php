<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitJob extends Model
{
    use HasFactory;

    public $fillable = ['job_id', 'hunter_id', 'creative_id', 'comment', 'path'];

    function job()
    {
        return $this->belongsTo(Job::class);
    }

    function hunter()
    {
        return $this->belongsTo(User::class, 'hunter_id');
    }

    function creative()
    {
        return $this->belongsTo(User::class, 'creative_id');
    }
}
