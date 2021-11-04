<?php

namespace App\Http\Controllers;

use App\ConceptoLiquidacion;
use App\Dpto;
use App\SubtipoCodigo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        return view('conceptos.index', ['user' => $user]);
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
            'cod_concepto' => 'required|unique:concepto_liquidacions,cod_concepto|integer|min:1',
            'concepto' => 'required|string|unique:concepto_liquidacions,concepto|max:50',
            'organismo_id' => 'required|exists:organismos,cod_organismo',
            'subtipo_id' => 'required|exists:subtipo_codigos,id'
        ]);

        $conceptoLiquidacion = ConceptoLiquidacion::create([
            'cod_concepto' => $request->cod_concepto,
            'concepto' => $request->concepto,
            'organismo_id' => $request->organismo_id,
            'subtipo_id' => $request->subtipo_id,
            'unidad' => $request->unidad
        ]);

        return $this->show($conceptoLiquidacion->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConceptoLiquidacion  $conceptoLiquidacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ConceptoLiquidacion::with(['organismo', 'subtipo', 'departamentos', 'users'])->where('id', $id)->first();
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

        $subtipo = SubtipoCodigo::find($request->subtipo_id);
        $dpto = Dpto::find(1);
        $user = User::find($request->user_id);

        $conceptoLiquidacion->departamentos()->attach($dpto->id, [
            'user_id' => $user->id, 'tipocodigo_id' => $subtipo->tipocodigo->id,
            'subtipo_id' => $subtipo->id, 'updated_at' => now()
        ]);

        // $subtipo->departamentos()->attach(1,['tipocodigo_id' => $subtipo->tipocodigo->id]);
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
        return ConceptoLiquidacion::with(['organismo', 'subtipo', 'departamentos', 'users'])->latest()->paginate($this->perPage);
    }


    public function paginado($perPage)
    {
        $this->perpPage = $perPage;
        $this->getConceptos();
    }


    public function search($search)
    {
        return ConceptoLiquidacion::searchConcepto($search)->with(['organismo', 'subtipo', 'departamentos', 'users'])->paginate($this->perPage);
    }
}
