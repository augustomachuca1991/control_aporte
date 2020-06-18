<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dpto extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
