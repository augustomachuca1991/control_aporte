<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaJurisdiccion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
