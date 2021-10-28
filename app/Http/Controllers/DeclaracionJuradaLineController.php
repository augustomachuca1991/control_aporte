<?php

namespace App\Http\Controllers;

use App\DeclaracionJuradaLine;
use Illuminate\Http\Request;

class DeclaracionJuradaLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $perPage = 3;

    public function index($id)
    {
        $ddjj_lines = DeclaracionJuradaLine::where('declaracionjurada_id', $id)->paginate($this->perPage);
        return view('declaraciones_juradas.show', [
            'lines' => $ddjj_lines
        ]);
    }


    public function getDeclaracionesJuradasLines($id)
    {

        return DeclaracionJuradaLine::where('declaracionjurada_id', $id)->paginate($this->perPage);
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
     * @param  \App\DeclaracionJuradaLine  $declaracionJuradaLine
     * @return \Illuminate\Http\Response
     */
    public function show($cabecera_id)
    {

        return DeclaracionJuradaLine::where('declaracionjurada_id', $cabecera_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeclaracionJuradaLine  $declaracionJuradaLine
     * @return \Illuminate\Http\Response
     */
    public function edit(DeclaracionJuradaLine $declaracionJuradaLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeclaracionJuradaLine  $declaracionJuradaLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeclaracionJuradaLine $declaracionJuradaLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJuradaLine  $declaracionJuradaLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeclaracionJuradaLine $declaracionJuradaLine)
    {
        //
    }
}
