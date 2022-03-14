<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gigquestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['question','gigId','userId'];

    public function gig()
    {
        return $this->BelongsTo(\App\Models\GiG::class, 'gigId','id');
    }

}
