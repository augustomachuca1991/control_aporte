<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class HistoriaLaboral extends Model
{
    //use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion','historia_liquidacion', 'h_laboral_id', 'liquidacion_id');
    }

    public function puesto()
    {
        return $this->belongsTo('App\PuestoLaboral')->with('agente');
    }

    public function clase()
    {
        return $this->belongsTo('App\Clase')->with('Categoria');
    }
}
