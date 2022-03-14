<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = ['faq','gigId','userId','answer'];

    public function gig()
    {
        return $this->belongsTo(\App\Models\GiG::class, 'gigId','id');
    }
}

