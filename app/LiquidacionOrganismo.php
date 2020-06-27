<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class LiquidacionOrganismo extends Model
{
    //
    //use SoftDeletes;
	protected $table = 'liquidacion_organismo';
    protected $dates = ['deleted_at'];

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
        return $this->belongsTo('App\TipoLiquidacion','tipo_id' , 'id');
    }

    public function liquidacion()
    {
        return $this->belongsTo('App\Liquidacion');
    }
}
