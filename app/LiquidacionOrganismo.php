<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiquidacionOrganismo extends Model
{
    use SoftDeletes;
	
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
        return $this->belongsTo('App\Liquidacion')->with('historia_laborales')->with('detalles');
    }


    public function scopeBuscarLiquidacion($query, $search)
    {
        # code...
        if(!empty($search)){
            $query->where('liquidacion_id' ,'LIKE' ,"%".$search."%");
            // ->orWhere('periodo' ,'LIKE' ,"%".$search."%")
            // ->orWhere('mes' ,'LIKE' ,"%".$search."%")
            // ->orWhere('anio' ,'LIKE' ,"%".$search."%");

        }
    }


    public function scopeBuscarPorAgente($query , $value)
    {
        if(!empty($value)){
            $query->whereHas('liquidacion',function($liquidaciones) use ($value){
                $liquidaciones->whereHas('historia_laborales' , function($historiaslaborales) use ($value){
                    $historiaslaborales->whereHas('puesto', function($puestos) use ($value){
                        $puestos->whereHas('agente', function($agente) use ($value){
                                $agente->where('nombre','like',"%".$value."%")
                                       ->orWhere('cuil','like',"%".$value."%");
                        });
                    });
                });
            });
        }
        

    }
}
