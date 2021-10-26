<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConceptoLiquidacion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "concepto_liquidacions";
    protected $fillable = [
        'cod_concepto',
        'concepto',
        'unidad',
        'organismo_id',
        'subtipo_id'
    ];

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

    public function liquidaciones()
    {
        return $this->belongsToMany('App\Liquidacion', 'liquidacion_detalles', 'id', 'concepto_id');
    }

    public function scopeSearchConcepto($query, $search)
    {
        if (!empty($search)) {
            $query->where('cod_concepto', 'LIKE', "%" . $search . "%")
                ->orWhere('concepto', 'LIKE', "%" . $search . "%")
                ->orWhere('unidad', 'LIKE', "%" . $search . "%");
        }
    }
}
