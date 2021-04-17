<?php

namespace App\Http\Controllers;

use App\ConceptoLiquidacion;
use Illuminate\Http\Request;

class ConceptoLiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('conceptos.index');
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
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(ConceptoLiquidacion $conceptoLiquidacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ConceptoLiquidacion $conceptoLiquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConceptoLiquidacion $conceptoLiquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConceptoLiquidacion $conceptoLiquidacion)
    {
        //
    }

    public function getConcepto()
    {
        return ConceptoLiquidacion::with('subtipo')->get();
    }
}
