<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclaracionJuradaLine extends Model
{
    //

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
