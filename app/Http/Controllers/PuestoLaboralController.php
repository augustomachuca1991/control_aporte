<?php

namespace App\Http\Controllers;

use App\PuestoLaboral;
use Illuminate\Http\Request;

class PuestoLaboralController extends Controller
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
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function show(PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function edit(PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuestoLaboral $puestoLaboral)
    {
        //
    }

    public function getpuestoLaboral()
    {
         return PuestoLaboral::with('clases')->get();
    }
}
