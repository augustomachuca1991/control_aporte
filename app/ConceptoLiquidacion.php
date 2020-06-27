<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ConceptoLiquidacion extends Model
{
    //use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function detalles()
    {
        return $this->hasMany('App\LiquidacionDetalle')->with('liquidacion');
    }

    
    public function subtipo()
    {
        return $this->belongsTo('App\SubtipoCodigo')->with('tipocodigo');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo');
    }

    //public function liquidaciones()
    //{
    //    return $this->belongsToMany('App\Liquidacion','liquidacion_detalles','id', 'concepto_id');
    //}
}
