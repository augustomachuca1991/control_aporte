<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriaLaboral extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['puesto_id', 'clase_id', 'fecha_inicio','fecha_fin'];


    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion','historia_liquidacion', 'h_laboral_id', 'liquidacion_id');
    }

    public function puesto()
    {
        return $this->belongsTo('App\PuestoLaboral')->with('agente')->with("organismo");
    }

    public function clase()
    {
        return $this->belongsTo('App\Clase')->with('Categoria');
    }

    public function historialiquidaciones()
    {
        return $this->hasMany('App\HistoriaLiquidacion', 'h_laboral_id', 'id')->with('estado')->with('funcion');
    }


}
