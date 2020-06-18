<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestoLaboral extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
