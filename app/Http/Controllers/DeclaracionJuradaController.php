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
        //LiquidacionJob::dispatch($declaracionJurada);
        //foreach ($declaracionJurada->ddjj_lines as $line) {

            //nueva liquidacion-----------------------------------------------------------
            // $liquidacion = Liquidacion::create([
            //     'declaracion_id' => $line->declaracionjurada_id,
            //     'bruto' => $line->aporte_personal/0.185,
            //     'bonificable' => $line->basico+$line->antiguedad,
            //     'no_bonificable' => 12,
            //     'no_remunerativo' => 12,
            //     'familiar' => $line->hijo+$line->esposa,
            //     'descuento' => $line->aporte_personal+0,
            // ]);

            //Categoria-------------------------------------------------------------------
            // $categoria = Categoria::where('cod_categoria', $line->cod_categoria);
            // if ($categoria->doesntExist()) {
            //     $categoria1 = Categoria::create([
            //         'cod_categoria' => $line->cod_categoria,
            //         'categoria' => $line->categoria,
            //     ]);
            //     //Clase------------------------------------------------------------------------
            //     $clase1 = New Clase();
            //     $clase1->cod_clase = $line->cod_clase;
            //     $clase1->categoria_id = $categoria1->id;
            //     $clase1->clase = $line->clase;
            //     $clase1->save();
            //     //Jurisdiccion------------------------------------------------------------------
            //     $jurisdiccion = Jurisdiccion::where('cod_jurisdiccion', $line->cod_jurisdiccion);
            //     if ($jurisdiccion->doesntExist()) {
            //         $jurisdiccion1 = Jurisdiccion::create([
            //             'cod_jurisdiccion' => $line->cod_jurisdiccion,
            //             'jurisdiccion' => $line->jurisdiccion,
            //             'origen_id' => $line->cod_origen,
            //         ]);
            //     }else{
            //         $jurisdiccion1 = $jurisdiccion->first();
            //     }
            //     $categoria1->jurisdicciones()->attach($jurisdiccion1->id);
            // }else{
            //     $categoria1 = $categoria->first();
            //     $clase = Clase::where('cod_clase', $line->cod_clase);
            //     if ($clase->doesntExist()) {
            //         $clase1 = Clase::create([
            //             'cod_clase' => $line->cod_clase,
            //             'clase' => $line->clase,
            //             'categoria_id' => $categoria1->cod_categoria,
            //         ]);
            //     } else {
            //         $clase1 = $clase->first();
            //     }
                
            // }

            //Agentes------------------------------------------------------------------
            // $agente = Agente::where('cuil', $line->cuil);
            // if ($agente->doesntExist()) {
            //     $agente1 = Agente::create([
            //         'nombre' => $line->nombre,
            //         'cuil' => $line->cuil,
            //         'fecha_nac' => date("Y-m-d", strtotime($line->fecha_nac)),
            //         'sexo' => $line->sexo,
            //     ]);
            //     $agente1->organismos()->attach($declaracionJurada->organismo_id,[
            //         'cod_laboral' => $line->puesto_laboral,
            //         'fecha_ingreso' => date("Y-m-d", strtotime($line->fecha_ingreso)),
            //         'fecha_egreso' => null,
            //     ]);
            //     $puesto_laboral = PuestoLaboral::where('cod_laboral',$line->puesto_laboral);
            //     // $puesto_laboral->clases()->attach($clase1->id,[
            //     //         'fecha_inicio' => date("Y-m-d", strtotime($line->fecha_ingreso)),
            //     //         'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString()
            //     // ]);
            // }else{
            //     $agente1 = $agente->first();
            //     $puesto_laboral = PuestoLaboral::where('cod_laboral' , $line->puesto_laboral);
            //     if ($puesto_laboral->doesntExist()) {
            //         $agente1->organismos()->attach($declaracionJurada->organismo_id,[
            //             'cod_laboral' => $line->puesto_laboral,
            //             'fecha_ingreso' => date("Y-m-d", strtotime($line->fecha_ingreso)),
            //             'fecha_egreso' => null,
            //         ]);
            //         // $puesto_laboral->first()->clases()->attach($clase1->id,[
            //         //     'fecha_inicio' => date("Y-m-d", strtotime($line->fecha_ingreso)),
            //         //     'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
            //         // ]);
            //     }
                
            // }

            // $puesto_laboral->first()->clases()->attach($clase1->id,[
            //     'fecha_inicio' => date("Y-m-d", strtotime($line->fecha_ingreso)),
            //     'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
            // ]);

            // $historia_laboral = $puesto_laboral->first()->historialaborales()->where('clase_id' , $clase1->id)->first();

            // $historia_laboral = HistoriaLaboral::where('puesto_id', $line->puesto_laboral)
            //                                     ->where('clase_id' , $line->cod_clase)
            //                                     ->first();

            

            // $liquidacion->organismos()->attach($declaracionJurada->organismo_id ,[
            //     'periodo_id' => $declaracionJurada->periodo_id , 
            //     'tipo_id' => $declaracionJurada->tipoliquidacion_id,
            //     'haber_bruto' => 12,
            //     'total_aporte_personal' => 13,
            //     'total_sueldo_basico' => 14, 
            //     'total_antiguedad' => 15,
            //     'total_adicional' => 16,
            //     'total_familiar' => 17,
            //     'total_hijo' => 18,
            //     'total_esposa' => 19,
            // ]);
            


            // $liquidacion->historia_laborales()->attach($historia_laboral->id,[ 
            //     'estado_id' => $line->cod_estado , 
            //     'funcion_id' => null
            // ]);

            // $liquidacion->conceptos()->attach(1,['unidad' => '30 dias','importe' => 50000]);
            // $liquidacion->conceptos()->attach(2,['unidad' => '34 años','importe' => 20000]);
            // $liquidacion->conceptos()->attach(3,['unidad' => null,     'importe' => 50000]);
            // $liquidacion->conceptos()->attach(4,['unidad' => '30 %',   'importe' => 10000]);
            // $liquidacion->conceptos()->attach(5,['unidad' => null,     'importe' => 50000]);
            // $liquidacion->conceptos()->attach(6,['unidad' => '18,5 %', 'importe' => 9250]);
            // $liquidacion->conceptos()->attach(7,['unidad' => '5%',     'importe' => 2500]);
            // $liquidacion->conceptos()->attach(8,['unidad' => '1',      'importe' => 1000]);
            // $liquidacion->conceptos()->attach(9,['unidad' => null,     'importe' => 100]);
            
            
        
        //}

        // $declaracionJurada->ddjj_lines()->delete();
        // $declaracionJurada->delete();
        // return $this->getDeclaracionesJuradas();
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

    public function download(Request $request)
    {
        $pathToFile = \Storage::url('app/'.$request->path);
        $header = [
               'Content-Type' => 'text/csv',
           ];
        return response()->download('..'.$pathToFile, 'descarga.csv',$header);
    }

}
