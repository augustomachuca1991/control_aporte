<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    

    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('periodos.index');
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
        $validar = $request->validate([
            'cod_periodo' => 'required|integer|unique:periodos,cod_periodo',
        ]);

        $periodo = Periodo::create([
            'cod_periodo' => $request->cod_periodo,
            'periodo' => $request->periodo,
            'mes' => $request->mes,
            'anio' => $request->anio,
        ]);

        return $periodo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       return Periodo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cod_periodo'     => 'required|unique:periodos,cod_periodo',
            'mes' => 'required|integer',
            'anio' => 'required|integer',
            'periodo' => 'required|string',
        ]);

        $periodo =  Periodo::find($id);
        $periodo->cod_periodo = $request->cod_periodo;
        $periodo->mes = $request->mes;
        $periodo->anio = $request->anio;
        $periodo->periodo = $request->periodo;
        $periodo->updated_at = now();
        $periodo->save();

        return $this->show($periodo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = Periodo::find($id);
        $nombre_periodo = $periodo->periodo;
        $periodo->delete();
        return $nombre_periodo;
    }

    public function getPeriodos(){

        return Periodo::latest()->paginate($this->perPage);
    }



    public function paginado($perPage){
        $this->perPage = $perPage;
        return $this->getPeriodos();
    }


    public function search($search)
    {

        
            return Periodo::filtroPeriodo($search)->paginate($this->perPage);

    }


}
