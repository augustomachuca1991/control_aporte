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

    public function ComputoOrigenes($periodo)
    {

        $computosOrigen = LiquidacionOrganismo::computoOrigen($periodo)->get();
        return $computosOrigen;
    }

    public function ComputoJurisdicciones($periodo)
    {

        $computosJurisdiccion = LiquidacionOrganismo::computoJurisdiccion($periodo)->get();
        return $computosJurisdiccion;
    }

    public function ComputoOrganismos($periodo)
    {

        $computosOrganismo = LiquidacionOrganismo::computoOrganismo($periodo)->get();
        return $computosOrganismo;
    }


    public function computoTipoLiquidacion_origen($id_tipoliquidacion)
    {

        // $tipo_id = $id_tipoliquidacion;
        // return LiquidacionOrganismo::whereHas('tipoliquidacion', function ($tipo) use ($tipo_id) {
        //     $tipo->where('id', $tipo_id);
        // })->with('liquidacion')->get();

        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
            ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
            ->join('jurisdiccions', 'organismos.jurisdiccion_id', '=', 'jurisdiccions.cod_jurisdiccion')
            ->join('origens', 'jurisdiccions.origen_id', '=', 'origens.cod_origen')
            ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
            ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
            ->join('liquidacions', 'liquidacion_organismo.liquidacion_id', '=', 'liquidacions.id')
            ->selectRaw('
                     origens.origen AS origen,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(liquidacions.bruto) AS haber_bruto,
                     SUM(liquidacions.aporte_personal) AS total_aporte_personal,
                     SUM(liquidacions.basico) AS total_sueldo_basico,
                     SUM(liquidacions.antiguedad) AS total_antiguedad,
                     SUM(liquidacions.adicionales) AS total_adicional,
                     SUM(liquidacions.familiar) AS total_familiar,
                     SUM(liquidacions.hijo) AS total_hijo,
                     SUM(liquidacions.esposa) AS total_esposa')
            ->groupBy('origen', 'periodo', 'tipo_liquidacion')->get();
        return $computos;
    }

    public function computoTipoLiquidacion_jurisdiccion($id_tipoliquidacion)
    {

        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
            ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
            ->join('jurisdiccions', 'organismos.jurisdiccion_id', '=', 'jurisdiccions.cod_jurisdiccion')
            ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
            ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
            ->join('liquidacions', 'liquidacion_organismo.liquidacion_id', '=', 'liquidacions.id')
            ->selectRaw('
                     jurisdiccions.jurisdiccion AS jurisdiccion,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(liquidacions.bruto) AS haber_bruto,
                     SUM(liquidacions.aporte_personal) AS total_aporte_personal,
                     SUM(liquidacions.basico) AS total_sueldo_basico,
                     SUM(liquidacions.antiguedad) AS total_antiguedad,
                     SUM(liquidacions.adicionales) AS total_adicional,
                     SUM(liquidacions.familiar) AS total_familiar,
                     SUM(liquidacions.hijo) AS total_hijo,
                     SUM(liquidacions.esposa) AS total_esposa')
            ->groupBy('jurisdiccion', 'periodo', 'tipo_liquidacion')->get();
        return $computos;
    }



    public function computoTipoLiquidacion_organismo($id_tipoliquidacion)
    {

        $computos = LiquidacionOrganismo::where('tipo_id', $id_tipoliquidacion)
            ->join('organismos', 'liquidacion_organismo.organismo_id', '=', 'organismos.cod_organismo')
            ->join('periodos', 'liquidacion_organismo.periodo_id', '=', 'periodos.cod_periodo')
            ->join('tipo_liquidacions', 'liquidacion_organismo.tipo_id', '=', 'tipo_liquidacions.id')
            ->join('liquidacions', 'liquidacion_organismo.liquidacion_id', '=', 'liquidacions.id')
            ->selectRaw('
                     organismos.organismo AS organismo,
                     periodos.periodo AS periodo,
                     tipo_liquidacions.descripcion AS tipo_liquidacion,
                     SUM(liquidacions.bruto) AS haber_bruto,
                     SUM(liquidacions.aporte_personal) AS total_aporte_personal,
                     SUM(liquidacions.basico) AS total_sueldo_basico,
                     SUM(liquidacions.antiguedad) AS total_antiguedad,
                     SUM(liquidacions.adicionales) AS total_adicional,
                     SUM(liquidacions.familiar) AS total_familiar,
                     SUM(liquidacions.hijo) AS total_hijo,
                     SUM(liquidacions.esposa) AS total_esposa')
            ->groupBy('organismo', 'periodo', 'tipo_liquidacion')->get();
        return $computos;
    }



    public function periodoAnual($anio)
    {

        return LiquidacionOrganismo::periodoAnual($anio)->get();
    }
}
