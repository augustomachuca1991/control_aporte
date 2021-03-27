<?php

namespace App\Http\Controllers;

use App\LiquidacionOrganismo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionOrganismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('computos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function show(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function edit(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    public function ComputoOrigenes($periodo){
        
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)
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
        ->groupBy('origen','periodo','tipo_liquidacion')->get();
        return $computos;
    }

    public function ComputoJurisdicciones($periodo){
        
        // $computos = LiquidacionOrganismo::where('periodo_id', $periodo)->whereHas('organismo', function($query){
        //     $query->whereHas('jurisdiccion',function($query2){
        //         $query2;
        //     });
        // })->with('organismo')->get()->groupBy('organismo.jurisdiccion.jurisdiccion');
        // return $computos;
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)
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
        ->groupBy('jurisdiccion','periodo','tipo_liquidacion')->get();
        return $computos;
    }

    public function ComputoOrganismos($periodo){
        
        // $computos = LiquidacionOrganismo::where('periodo_id', $periodo)->whereHas('organismo', function($query){
        //     $query;
        // })->with('organismo')->get()->groupBy('organismo.organismo');
        // return $computos;
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)
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
        ->groupBy('organismo','periodo','tipo_liquidacion')->get();
        return $computos;
    }


    public function computoTipoLiquidacion_origen($id_tipoliquidacion)
    {
        
        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
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
        ->groupBy('origen','periodo','tipo_liquidacion')->get();
        return $computos;

    }

    public function computoTipoLiquidacion_jurisdiccion($id_tipoliquidacion)
    {
        
        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
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
        ->groupBy('jurisdiccion','periodo','tipo_liquidacion')->get();
        return $computos;

    }



    public function computoTipoLiquidacion_organismo($id_tipoliquidacion)
    {
        
        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
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
        ->groupBy('organismo','periodo','tipo_liquidacion')->get();
        return $computos;

    }

}

