<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'publisher','description'];

    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
  
}    