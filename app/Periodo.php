<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Periodo extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }

    public function organismos()
    {
    	return $this->belongsToMany('App\Organismo');
    }

    public function tipoLiquidaciones()
    {
    	return $this->belongsToMany('App\TipoLiquidacion');
    }
}
