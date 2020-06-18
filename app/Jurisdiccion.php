<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurisdiccion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
