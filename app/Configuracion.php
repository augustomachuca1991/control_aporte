<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Configuracion extends Model
{
    //use SoftDeletes;

    protected $dates = ['deleted_at'];
}
