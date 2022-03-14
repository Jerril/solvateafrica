<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['name'];

    public function skill()
    {
        return $this->hasMany(\App\Models\Skill::class, 'category_id','id');
    }
}
