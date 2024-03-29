<?php

namespace App\Http\Controllers;

use App\Dpto;
use Illuminate\Http\Request;

class DptoController extends Controller
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
     * @param  \App\Dpto  $dpto
     * @return \Illuminate\Http\Response
     */
    public function show(Dpto $dpto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dpto  $dpto
     * @return \Illuminate\Http\Response
     */
    public function edit(Dpto $dpto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dpto  $dpto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dpto $dpto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dpto  $dpto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dpto $dpto)
    {
        //
    }


    public function getDptos(){
        return Dpto::with(['conceptos'])->get();
    }
}
