<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubtipoCodigo extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
