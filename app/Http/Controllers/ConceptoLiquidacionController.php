<?php

namespace App\Http\Controllers;

use App\ConceptoLiquidacion;
use Illuminate\Http\Request;

class ConceptoLiquidacionController extends Controller
{


    public $perPage = 10;
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
    public function show($id)
    {
        return ConceptoLiquidacion::with(['organismo', 'subtipo'])->where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'concepto' => 'required|string|max:50',
            'subtipo_id' => 'required|exists:subtipo_codigos,id',
        ]);

        $conceptoLiquidacion = ConceptoLiquidacion::find($id);

        $conceptoLiquidacion->update([
            'concepto' => $request->concepto,
            'unidad' => $request->unidad,
            'subtipo_id' => $request->subtipo_id
        ]);

        return $this->show($conceptoLiquidacion->id);
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

    public function getConceptos()
    {
        return ConceptoLiquidacion::with(['organismo', 'subtipo'])->paginate($this->perPage);
    }
}
