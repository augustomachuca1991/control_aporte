<?php

namespace App\Http\Controllers;

use App\{DeclaracionJurada,Liquidacion,Agente};
use Illuminate\Http\Request;

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
        foreach ($declaracionJurada->ddjj_lines as $line) {
            $noExisteAgente = Agente::where('cuil', $line->cuil)->doesntExist();
            if ($noExisteAgente) {
                $agente = Agente::create([
                    'nombre' => $line->nombre,
                    'cuil' => $line->cuil,
                    'fecha_nac' => date("Y-m-d", strtotime($line->fecha_nac)),
                    'sexo' => $line->sexo,
                ]);
                # code...
            }else{
                #code
            }


            $liquidacion = Liquidacion::create([
                'declaracion_id' => $line->declaracionjurada_id,
                'bruto' => 12,
                'bonificable' => 12,
                'no_bonificable' => 12,
                'no_remunerativo' => 12,
                'familiar' => 12,
                'descuento' => 12,
            ]);
            $liquidacion->organismos()->attach($declaracionJurada->organismo_id ,
                [
                    'periodo_id' => $declaracionJurada->periodo_id , 
                    'tipo_id' => $declaracionJurada->tipoliquidacion_id
                ]
            );
            //$liquidacion->historia_laborales()->attach(3,['estado_id' => 1 , 'funcion_id' => null]);

            $liquidacion->conceptos()->attach(1,['unidad' =>'2%','importe'=> 5000]);
        }

        $declaracionJurada->ddjj_lines()->delete();
        $declaracionJurada->delete();
        return $this->getDeclaracionesJuradas();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function getDeclaracionesJuradas(){
        return DeclaracionJurada::whereHas('ddjj_lines')->with(['organismo', 'user','periodo', 'tipoliquidacion'])->orderBy('id', 'desc')->get();
    }

}
