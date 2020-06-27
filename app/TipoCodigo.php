<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class TipoCodigo extends Model
{
    //
    //use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function subtipos()
    {
        return $this->hasMany('App\SubtipoCodigo' , 'id', 'tipocodigo_id')->with('conceptos');
    }
}
