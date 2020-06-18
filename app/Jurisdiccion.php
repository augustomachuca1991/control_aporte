<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Jurisdiccion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
