<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\Liquidacion;
use App\LiquidacionOrganismo;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    

    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liquidaciones.index');
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
     * Muestra una liquidacion especifica con su respectivo detalle.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $liquidacion = Liquidacion::where('id',$id)
                       ->with(['liquidacionOrganismo','historia_laborales','detalles'])
                       ->first();
            foreach ($liquidacion->detalles as $detalle) {
                switch ($detalle->concepto->subtipo->tipocodigo->id) {
                    case 1:
                        $liquidacion->bruto += $detalle->importe;
                        break;
                    case 2:
                        $liquidacion->bonificable += $detalle->importe;
                        break;
                    case 3:
                        $liquidacion->no_bonificable += $detalle->importe;
                        break;
                    case 4:
                        $liquidacion->no_remunerativo += $detalle->importe;
                        break;
                    case 5:
                       $liquidacion->familiar += $detalle->importe;
                        break;
                    case 6:
                        $liquidacion->descuento += $detalle->importe;
                        break;
                    
                    default:
                        break;
                }
            }
        return $liquidacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        
    }

    /**
     * obtener todas las liquidaciones almacenadas.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function getliquidaciones()
    {
        
        return LiquidacionOrganismo::with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])->get();
    }


    /**
     * filtro de busqueda.
     * buscar por periodo de liquidacion, por tipo de liquidacion
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     * $periodo=null, $tipo=null, $organismo=null, $jur=null, $origen=null
     */
    // public function filtro(Request $request)
    // {
        
    //     $periodo = $request->periodo;
    //     $tipo = $request->tipo_liquidacion;
    //     $organismo = $request->organismo;
    //     $jur = $request->jurisdiccion;
    //     $origen = $request->origen;
    //     if ($organismo) { 
    //         $liquidaciones = Liquidacion::whereHas('liquidacionOrganismo' , function($query) use ($organismo){
    //             $query->whereHas('organismo', function($query2) use ($organismo){
    //                 $query2->where('cod_organismo' , $organismo);
    //             });
    //         });
    //     }else{
    //         if ($jur) {
    //             $liquidaciones =  Liquidacion::whereHas('liquidacionOrganismo' , function($query) use ($jur){
    //                 $query->whereHas('organismo', function($query2) use ($jur){
    //                     $query2->whereHas('jurisdiccion',function($query3) use ($jur){
    //                         $query3->where('cod_jurisdiccion' , $jur);
    //                     });
    //                 });
    //             });
    //         }else if($origen){
    //             $liquidaciones =  Liquidacion::whereHas('liquidacionOrganismo' , function($query) use ($origen){
    //                 $query->whereHas('organismo', function($query2) use ($origen){
    //                     $query2->whereHas('jurisdiccion', function($query3) use ($origen){
    //                         $query3->whereHas('origen', function($query4) use ($origen){
    //                             $query4->where('cod_origen' , $origen);
    //                         });
    //                     });
    //                 });
    //             });
    //         }
    //     }


    //     return $liquidaciones->with(['liquidacionOrganismo','historia_laborales'])->paginate(50);
        
    // }


        

    

    /**
     * busca liquidaciones segun su nombre o cuil.
     * 
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    // public function agente(Request $request)
    // {
    //     $buscar = $request->search;
    //     return Liquidacion::whereHas('historia_laborales', function($query) use ($buscar){
    //         $query->whereHas('puesto', function($query2) use ($buscar){
    //             $query2->whereHas('agente', function($query3) use ($buscar){
    //                     $query3->where('nombre','like',"%".$buscar."%")
    //                            ->orWhere('cuil','like',"%".$buscar."%");
    //             });
    //         });
    //     })->with(['liquidacionOrganismo','historia_laborales'])->paginate($this->perPage);
                    
    // }

    public function porOrigen(Request $request, $value)
    {
        $liquidaciones = LiquidacionOrganismo::whereHas('organismo', function($organismos) use ($value){
            $organismos->whereHas('jurisdiccion',function($jurisdicciones) use ($value){
                $jurisdicciones->where('origen_id' , $value);
            });
        })
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();
        return $liquidaciones;
        // return LiquidacionOrganismo::whereHas('organismo', function($organismos) use ($value){
        //     $organismos->whereHas('jurisdiccion',function($jurisdicciones) use ($value){
        //         $jurisdicciones->where('origen_id' , $value);
        //     });
        // })
        // ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])->get();
    }



    public function porJurisdiccion(Request $request, $value)
    {


        return LiquidacionOrganismo::whereHas('organismo', function($organismos) use ($value){
            $organismos->where('jurisdiccion_id', $value);
        })
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();
    }



    public function porOrganismo(Request $request, $value)
    {


        return LiquidacionOrganismo::where('organismo_id', $value)
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();    
    }


    public function porAgente(Request $request, $value)
    {


        return LiquidacionOrganismo::buscarPorAgente($value)
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();   
    }


    public function porPeriodo(Request $request, $value)
    {


        return LiquidacionOrganismo::where('periodo_id', $value)
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();  
    }

    public function porTipo(Request $request, $value)
    {


        return LiquidacionOrganismo::where('tipo_id', $value)
        ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
        ->get();  
    }


    public function search($search){

        return LiquidacionOrganismo::buscarLiquidacion($search)
                ->with(['organismo','liquidacion', 'tipoliquidacion', 'periodo'])
                ->get();

    }


    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getliquidaciones();
    }


    public function hl()
    {
        return Liquidacion::with('historia_laborales')->get();
    }


    public function filtro($agente,$periodo,$tipo)
    {
        # code...
        if ($agente && $periodo && $tipo) {
            # code...
            $query = LiquidacionOrganismo::buscarPorAgente($agente)->where('periodo_id', $periodo)->where('tipo_id', $tipo);
        }else if($agente && $periodo && !$tipo) {
            # code...
            $query = LiquidacionOrganismo::buscarPorAgente($agente)->where('periodo_id', $periodo);
        }else if($agente && !$periodo && $tipo) {
            # code...
            $query = LiquidacionOrganismo::buscarPorAgente($agente)->where('tipo_id', $tipo);
        }else if($agente && !$periodo && !$tipo) {
            # code...
            $query = LiquidacionOrganismo::buscarPorAgente($agente);
        }else if(!$agente && $periodo && $tipo) {
            # code...
            $query = LiquidacionOrganismo::where('periodo_id', $periodo)->where('tipo_id', $tipo);
        }else if(!$agente && $periodo && !$tipo) {
            # code...
            $query = LiquidacionOrganismo::where('periodo_id', $periodo);
        }else if(!$agente && !$periodo && $tipo) {
            # code...
            $query = LiquidacionOrganismo::where('tipo_id', $tipo);
        }else {
            # code...
            $query = LiquidacionOrganismo::all();
        }
        return $query;
    }

    public function secuencia()
    {
        
        return LiquidacionOrganismo::liquidacionesRectificadas()->get();
    }


}
        

        


