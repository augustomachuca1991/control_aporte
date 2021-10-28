<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubtipoCodigo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['descripcion', 'tipocodigo_id'];

    public function conceptos()
    {
        return $this->hasMany('App\ConceptoLiquidacion')->with('detalles');
    }

    public function tipocodigo()
    {
        return $this->belongsTo('App\TipoCodigo');
    }
}
