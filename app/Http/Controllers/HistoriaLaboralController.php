<?php

namespace App\Http\Controllers;

use App\HistoriaLaboral;
use Illuminate\Http\Request;

class HistoriaLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('historia_laborales.index');
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
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    public function getHistoriaLaborales(HistoriaLaboral $historiaLaboral)
    {
        try{
            return HistoriaLaboral::with('agente')->get();
        }catch (\Exception $e){
            return [];
        }
    }

    public function puestoHistoriaLaboralSelected($id){
        try{
            return HistoriaLaboral::with('clase')->where('puesto_id',$id)->get();
        }catch (\Exception $e){
            return [];
        }
    }

}
