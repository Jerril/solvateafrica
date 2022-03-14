<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trackorder extends Model
{
    use HasFactory;

    public $fillable = ['job_id', 'hunter_id', 'talent_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
