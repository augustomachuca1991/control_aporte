<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
