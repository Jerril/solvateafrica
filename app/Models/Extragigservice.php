<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extragigservice extends Model
{
    use HasFactory;
    public $fillable = ['description','revision','price','gigId','userId'];

}
