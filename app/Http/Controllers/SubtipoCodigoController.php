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
    public $perPage = 10;

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
        $request->validate([
            'descripcion' => 'required|string|max:30|unique:subtipo_codigos,descripcion',
            'tipocodigo_id' => 'required|exists:tipo_codigos,id'
        ]);

        $subtipo = SubtipoCodigo::create([
            'descripcion' => $request->descripcion,
            'tipocodigo_id' => $request->tipocodigo_id
        ]);
        return $this->show($subtipo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubtipoCodigo  $subtipoCodigo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SubtipoCodigo::with('tipocodigo')->where('id' , $id)->first();
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


    public function search($search)
    {
        return SubtipoCodigo::searchSubtipo($search)->with('tipocodigo')->get();
    }
}
