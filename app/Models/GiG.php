<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiG extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "gigs";

    public $fillable = ['title','categoryId','skillId','description','userId'];

    public function category()
    {
        return $this->BelongsTo(\App\Models\Category::class, 'categoryId','id');
    }

    public function skill()
    {
        return $this->BelongsTo(\App\Models\Skill::class, 'skillId','id');
    }

    public function faqs()
    {
        return $this->hasMany(\App\Models\Faq::class, 'gigId','id');
    }

    public function questions()
    {
        return $this->hasMany(\App\Models\Gigquestion::class, 'gigId','id');
    }

    public function extraservice()
    {
        return $this->hasMany(\App\Models\Extragigservice::class, 'gigId','id');
    }

    public function tags()
    {
        return $this->hasMany(\App\Models\Tag::class, 'gigId','id');
    }

    public function scopepackage()
    {
        return $this->hasMany(\App\Models\Scopepackage::class, 'gigId','id');
    }

    public function user()
    {
        return $this->BelongsTo(\App\Models\User::class, 'userId','id');
    }

     public function userdetail()
    {
        return $this->BelongsTo(\App\Models\UserDetail::class, 'userId','userId');
    }
}

