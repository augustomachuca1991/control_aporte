<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Organismo extends Model
{

	use SoftDeletes;
    protected $table = 'organismos';
    protected $fillable = ['cod_organismo', 'jurisdiccion_id', 'organismo'];
    protected $dates = ['deleted_at'];

    public function jurisdiccion()
    {
        return $this->belongsTo('App\Jurisdiccion','jurisdiccion_id' , 'cod_jurisdiccion')->with('origen');
    }

    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }

    public function periodos()
    {
    	return $this->belongsToMany('App\Periodo');
    }


	 public function tipoLiquidaciones()
    {
    	return $this->belongsToMany('App\TipoLiquidacion');
    }

    public function agentes(){

        return $this->belongsToMany( 'App\Agente');
    }

    public function conceptos()
    {
        return $this->hasMany('App\ConceptoLiquidacion');
    }

    public function liquidacionOrganismo()
    {
        return $this->hasMany('App\LiquidacionOrganismo')->with(['liquidacion','periodo','tipoLiquidacion']);
    }

    public function estados()
    {
        return $this->hasMany('App\Estado');
    }

    public function funciones()
    {
        return $this->hasMany('App\Funcion');
    }

<<<<<<< HEAD
    public function puestolaborales()
    {
        return $this->hasMany('App\PuestoLaborales');
=======
    public function declaracionesJuradas()
    {
        return $this->hasMany('App\DeclaracionJurada');
>>>>>>> 756c46bd1adb595b66e35301fddf7e363f342034
    }
}
