<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ConceptoLiquidacion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function detalles()
    {
        return $this->hasMany('App\LiquidacionDetalle');
    }

    public function subtipocodigo()
    {
        return $this->belongsTo('App\SubtipoCodigo');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo');
    }
}
