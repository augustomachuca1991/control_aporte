<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class TipoLiquidacion extends Model
{
    //
    //use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }

    public function organismos()
    {
    	return $this->belongsToMany('App\Organismo');
    }

    public function periodos()
    {
    	return $this->belongsToMany('App\Periodo');
    }

    public function liquidacionOrganismo()
    {
        return $this->hasMany('App\LiquidacionOrganismo')->with(['organismo','periodo','liquidacion']);
    }
}
