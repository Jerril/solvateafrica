<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskContainer extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['name','projectId','userId','taskcontainerId'];

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class,'taskcontainerId','id');
    }
}
