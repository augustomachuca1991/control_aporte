<?php

namespace App\Http\Controllers;

use App\SubtipoCodigo;
use Illuminate\Http\Request;

class SubtipoCodigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subtipos.index');
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
     * @param  \App\SubtipoCodigo  $subtipoCodigo
     * @return \Illuminate\Http\Response
     */
    public function show(SubtipoCodigo $subtipoCodigo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubtipoCodigo  $subtipoCodigo
     * @return \Illuminate\Http\Response
     */
    public function edit(SubtipoCodigo $subtipoCodigo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubtipoCodigo  $subtipoCodigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubtipoCodigo $subtipoCodigo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubtipoCodigo  $subtipoCodigo
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubtipoCodigo $subtipoCodigo)
    {
        //
    }

    public function getSubtipo()
    {
        return SubtipoCodigo::with('tipocodigo')->get();
    }
}
