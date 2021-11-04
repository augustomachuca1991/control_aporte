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

    // public function departamentos(){

    //     return $this->belongsToMany('App\Dpto','configuracions','subtipo_id', 'dpto_id');
    // }

    public function scopeSearchSubtipo($query, $search)
    {
        if (!empty($search)) {
            // $query->whereHas('tipocodigo', function($tipo) use ($search){
            //     $tipo->where('descripcion', 'LIKE', "%" . $search . "%" );
            // })->where('descripcion', 'LIKE', "%" . $search . "%");
            $query->where('descripcion', 'LIKE', "%" . $search . "%");
        }
    }
}
