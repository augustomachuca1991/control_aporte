<?php

namespace App\Http\Controllers;

use App\TipoLiquidacion;
use Illuminate\Http\Request;

class TipoLiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\TipoLiquidacion  $tipoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLiquidacion $tipoLiquidacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoLiquidacion  $tipoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLiquidacion $tipoLiquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoLiquidacion  $tipoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoLiquidacion $tipoLiquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoLiquidacion  $tipoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoLiquidacion $tipoLiquidacion)
    {
        //
    }

    public function getTipoLiquidacion(){

        return TipoLiquidacion::all();
    }
}
