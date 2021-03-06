<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origen extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function jurisdicciones()
    {
        return $this->hasMany('App\Jurisdiccion')->with('organismos')->with('categorias');
    }
}
