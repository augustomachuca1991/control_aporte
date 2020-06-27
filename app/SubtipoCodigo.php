<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class SubtipoCodigo extends Model
{
    //
    //use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function conceptos()
    {
        return $this->hasMany('App\ConceptoLiquidacion')->with('detalles');
    }

    public function tipocodigo()
    {
        return $this->belongsTo('App\TipoCodigo');
    }
}
