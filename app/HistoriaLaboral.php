<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriaLaboral extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'puesto_id',
        'clase_id',
        'fecha_inicio',
        'fecha_fin'
    ];


    public function liquidaciones()
    {
        return $this->belongsToMany('App\Liquidacion', 'historia_liquidacion', 'h_laboral_id', 'liquidacion_id');
    }

    public function puesto()
    {
        return $this->belongsTo('App\PuestoLaboral', 'puesto_id', 'cod_laboral')->with('agente')->with("organismo");
    }

    public function clase()
    {
        return $this->belongsTo('App\Clase')->with('Categoria');
    }

    public function historialiquidaciones()
    {
        return $this->hasMany('App\HistoriaLiquidacion', 'h_laboral_id', 'id')->with('estado')->with('funcion');
    }

    public function scopeBuscarPorPuesto($query, $search)
    {
        if (!empty($search)) {
            $query->whereHas('puesto', function ($puestos) use ($search) {
                $puestos->where('cod_laboral', $search);
            })->with('puesto');
        }
    }


    public function scopeBuscarPorCuil($query, $search)
    {
        if (!empty($search)) {
            $query->whereHas('puesto', function ($puestos) use ($search) {
                $puestos->whereHas('agente', function ($agentes) use ($search) {
                    $agentes->where('cuil', $search);
                });
            })->with('puesto');
        }
    }
}
