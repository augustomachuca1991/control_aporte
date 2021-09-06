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



    public function scopeComputoOrigen($query, $periodo){

        $query->where('periodo_id', $periodo)
        ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
        ->join('jurisdiccions', 'organismos.jurisdiccion_id', '=', 'jurisdiccions.cod_jurisdiccion')
        ->join('origens', 'jurisdiccions.origen_id', '=', 'origens.cod_origen')
        ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
        ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
        ->selectRaw('
                     origens.origen AS origen,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(haber_bruto) AS haber_bruto,
                     SUM(total_aporte_personal) AS total_aporte_personal,
                     SUM(total_sueldo_basico) AS total_sueldo_basico, 
                     SUM(total_antiguedad) AS total_antiguedad, 
                     SUM(total_adicional) AS total_adicional,
                     SUM(total_familiar) AS total_familiar,
                     SUM(total_hijo) AS total_hijo,
                     SUM(total_esposa) AS total_esposa')
        ->groupBy('origen','periodo','tipo_liquidacion');

    }


    public function scopeComputoJurisdiccion($query, $periodo){

        $query->where('periodo_id', $periodo)
        ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
        ->join('jurisdiccions', 'organismos.jurisdiccion_id', '=', 'jurisdiccions.cod_jurisdiccion')
        ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
        ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
        ->selectRaw('
                     jurisdiccions.jurisdiccion AS jurisdiccion,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(haber_bruto) AS haber_bruto,
                     SUM(total_aporte_personal) AS total_aporte_personal,
                     SUM(total_sueldo_basico) AS total_sueldo_basico, 
                     SUM(total_antiguedad) AS total_antiguedad, 
                     SUM(total_adicional) AS total_adicional,
                     SUM(total_familiar) AS total_familiar,
                     SUM(total_hijo) AS total_hijo,
                     SUM(total_esposa) AS total_esposa')
        ->groupBy('jurisdiccion','periodo','tipo_liquidacion');

    }



    public function scopeComputoOrganismo($query, $periodo){

        $query->where('periodo_id', $periodo)
        ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
        ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
        ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
        ->selectRaw('
                     organismos.organismo AS organismo,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(haber_bruto) AS haber_bruto,
                     SUM(total_aporte_personal) AS total_aporte_personal,
                     SUM(total_sueldo_basico) AS total_sueldo_basico, 
                     SUM(total_antiguedad) AS total_antiguedad, 
                     SUM(total_adicional) AS total_adicional,
                     SUM(total_familiar) AS total_familiar,
                     SUM(total_hijo) AS total_hijo,
                     SUM(total_esposa) AS total_esposa')
        ->groupBy('organismo','periodo','tipo_liquidacion');
    }



    public function scopePeriodoAnual($query, $anio){

        $query->join('periodos', function($join) use ($anio){
            $join->on('liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
                ->where('liquidacion_organismo.deleted_at', '=', null)
                ->where('periodos.anio', '=', $anio)
                ->where('periodos.deleted_at', '=', null);
        })
        ->selectRaw('
                     periodos.anio as anual,
                     periodos.mes as mes,
                     SUM(haber_bruto) AS haber_bruto,
                     SUM(total_aporte_personal) AS total_aporte_personal,
                     SUM(total_sueldo_basico) AS total_sueldo_basico, 
                     SUM(total_antiguedad) AS total_antiguedad, 
                     SUM(total_adicional) AS total_adicional,
                     SUM(total_familiar) AS total_familiar,
                     SUM(total_hijo) AS total_hijo,
                     SUM(total_esposa) AS total_esposa')
        ->groupBy('anual','mes');
    }
}
