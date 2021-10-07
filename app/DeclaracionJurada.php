<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclaracionJurada extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'periodo_id','tipoliquidacion_id','organismo_id', 'secuencia','path','nombre_archivo','status', 'rectificar'];

    public function ddjj_lines()
    {
        return $this->hasMany('App\DeclaracionJuradaLine','declaracionjurada_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo')->with('jurisdiccion');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Periodo', 'periodo_id' , 'cod_periodo');
    }

    public function tipoliquidacion()
    {
        return $this->belongsTo('App\TipoLiquidacion');
    }
}
