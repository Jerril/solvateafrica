<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','conferring_organization', 'title','description','year'];

    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
 
}