<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
