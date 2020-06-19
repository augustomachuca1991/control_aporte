<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Organismo extends Model
{
    
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function jurisdiccion()
    {
        return $this->belongsTo('App\Jurisdiccion');
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
}
