<?php

namespace App\Http\Controllers;

use App\{DeclaracionJurada,Liquidacion,Agente,PuestoLaboral,Clase,Categoria,HistoriaLaboral,Jurisdiccion};
use Illuminate\Http\Request;
use App\Jobs\LiquidacionJob;

class DeclaracionJuradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('declaraciones_juradas.index');
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
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function show(DeclaracionJurada $declaracionJurada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function edit(DeclaracionJurada $declaracionJurada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeclaracionJurada $declaracionJurada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $declaracionJurada = DeclaracionJurada::find($id);
        
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function getDeclaracionesJuradas(){
        return DeclaracionJurada::whereHas('ddjj_lines')->with(
            ['organismo', 'user','periodo', 'tipoliquidacion']
        )->orderBy('id', 'desc')->get();
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $pathToFile = \Storage::url('app/'.$request->path);
        $header = ['Content-Type' => 'text/csv'];
        return response()->download('..'.$pathToFile, 'descarga.csv',$header);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function search($buscar)
    {
        return DeclaracionJurada::whereHas('user', function($query) use($buscar){
                    $query->where('name','LIKE',"%".$buscar."%");
            })->orWhereHas('periodo', function($query) use($buscar){
                    $query->where('periodo','LIKE',"%".$buscar."%");
            })->orWhereHas('tipoliquidacion', function($query) use($buscar){
                    $query->where('descripcion','LIKE',"%".$buscar."%");
            })->orWhereHas('organismo', function($query) use($buscar){
                    $query->where('organismo','LIKE',"%".$buscar."%");
            })
        ->with(['organismo', 'user','periodo', 'tipoliquidacion'])
        //->orWhere('periodo_id' ,'LIKE' ,"%".$search."%")
        ->get();
    }

}
