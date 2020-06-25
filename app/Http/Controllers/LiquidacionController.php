<?php

namespace App\Http\Controllers;

use App\Liquidacion;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liquidacion.index');
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
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $liquidaciones = Liquidacion::where('id',$id)
                        ->with(['organismos','periodos','tipoLiquidaciones','historia_laborales','detalles'])
                        ->get();
        foreach ($liquidaciones as $liquidacion) {
            foreach ($liquidacion->detalles as $detalle) {
                if ($detalle->concepto->subtipo->tipocodigo->id == 1) {
                    $liquidacion->bruto += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 2) {
                    $liquidacion->bonificable += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 3) {
                    $liquidacion->no_bonificable += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 4) {
                    $liquidacion->no_remunerativo += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 5) {
                    $liquidacion->familiar += $detalle->importe;
                }else{
                    $liquidacion->descuento += $detalle->importe;
                }
            }
        }
        return $liquidaciones;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        //
    }

    public function getliquidaciones()
    {
        
        return Liquidacion::with(['organismos','periodos','tipoLiquidaciones','historia_laborales'])->get();
    }


}
