<?php

namespace App\Http\Controllers;

use App\{DeclaracionJurada,Liquidacion,Agente,PuestoLaboral,Clase,Categoria,HistoriaLaboral};
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
            //clases y categorias
            $clase = Clase::where('cod_clase', $line->cod_clase);
            if ($clase->doesntExist()) {
                $categoria = Categoria::where('cod_categoria', 1);//luego remplazar 1 por $line->cod_categoria
                if ($categoria->doesntExist()) {
                    $categoria1 = Categoria::create([
                        'cod_categoria' => 1,//luego remplazar 1 por $line->cod_categoria
                        'categoria' => 'Policia',
                    ]);
                    $categoria1->jurisdicciones()->attach($line->cod_jurisdiccion);
                }else{
                    $categoria1 = $categoria->first();
                }
                $clase1 = Clase::create([
                    'cod_clase' => $line->cod_clase,
                    'categoria_id' => $categoria1->cod_categoria,
                    'clase' => $line->clase,
                ]);
            }else{
                $clase1 = $clase->first();
            }

            //agentes
            $agente = Agente::where('cuil', $line->cuil);
            if ($agente->doesntExist()) {
                $agente1 = Agente::create([
                    'nombre' => $line->nombre,
                    'cuil' => $line->cuil,
                    'fecha_nac' => date("Y-m-d", strtotime($line->fecha_nac)),
                    'sexo' => $line->sexo,
                ]);
                $agente1->organismos()->attach($declaracionJurada->organismo_id,[
                    'cod_laboral' => $line->puesto_laboral,
                    'fecha_ingreso' => date("Y-m-d", strtotime($line->fecha_ingreso)),
                    'fecha_egreso' => null,
                ]);
                $puesto_laboral = PuestoLaboral::where('cod_laboral',$line->puesto_laboral);
                $puesto_laboral->first()->clases()->attach($clase1->id,[
                        'fecha_inicio' => date("Y-m-d", strtotime($line->fecha_ingreso)),
                        'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString()
                ]);
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

            $liquidacion->organismos()->attach($declaracionJurada->organismo_id ,[
                'periodo_id' => $declaracionJurada->periodo_id , 
                'tipo_id' => $declaracionJurada->tipoliquidacion_id
            ]);
            
            $historia_laboral= HistoriaLaboral::where('puesto_id', $line->puesto_laboral)->where('clase_id' , $line->cod_clase)->first();

            $liquidacion->historia_laborales()->attach($historia_laboral->id,[
                'estado_id' => $line->cod_estado , 
                'funcion_id' => null
            ]);
            
            $liquidacion->conceptos()->attach(1,['unidad' => '30 dias','importe' => 50000]);
            $liquidacion->conceptos()->attach(2,['unidad' => '34 años','importe' => 20000]);
            $liquidacion->conceptos()->attach(3,['unidad' => null,     'importe' => 50000]);
            $liquidacion->conceptos()->attach(4,['unidad' => '30 %',   'importe' => 10000]);
            $liquidacion->conceptos()->attach(5,['unidad' => null,     'importe' => 50000]);
            $liquidacion->conceptos()->attach(6,['unidad' => '18,5 %', 'importe' => 9250]);
            $liquidacion->conceptos()->attach(7,['unidad' => '5%',     'importe' => 2500]);
            $liquidacion->conceptos()->attach(8,['unidad' => '1',      'importe' => 1000]);
            $liquidacion->conceptos()->attach(9,['unidad' => null,     'importe' => 100]);
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
