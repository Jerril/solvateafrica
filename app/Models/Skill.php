<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

     protected $fillable = ['name','slug', 'project_count','user_count','open_project_count','active_job_count','job_count','is_active','category_id'];

     /**
     * The users that belong to the skill.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'skill_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

}


                