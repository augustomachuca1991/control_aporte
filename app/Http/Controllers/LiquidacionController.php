<?php

namespace App\Http\Controllers;

use App\Liquidacion;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liquidacion.index');
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
                if ($detalle->concepto->subtipo->tipocodigo->id == 1) {
                    $liquidacion->bruto += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 2) {
                    $liquidacion->bonificable += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 3) {
                    $liquidacion->no_bonificable += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 4) {
                    $liquidacion->no_remunerativo += $detalle->importe;
                }elseif ($detalle->concepto->subtipo->tipocodigo->id == 5) {
                    $liquidacion->familiar += $detalle->importe;
                }else{
                    $liquidacion->descuento += $detalle->importe;
                }
            }
        //$liquidacion->save();
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
        
        return Liquidacion::with(['liquidacionOrganismo','historia_laborales'])->paginate(10);
    }


    /**
     * filtro de busqueda.
     * buscar por periodo de liquidacion, por tipo de liquidacion
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     * $periodo=null, $tipo=null, $organismo=null, $jur=null, $origen=null
     */
    public function filtro(Request $request)
    {
        $periodo = $request->periodo;
        $tipo = $request->tipo_liquidacion;
        $organismo = $request->organismo;
        $jur = $request->jurisdiccion;
        $origen = $request->origen;
        return Liquidacion::whereHas('liquidacionOrganismo',function($query) use($periodo, $tipo, $organismo, $jur, $origen){

            if ($origen) {
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                }
            } else if($jur) {
                $origen = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                }
            }else if($organismo){
                $origen = 0;
                $jur = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                }
            }else{
                $origen = 0;
                $jur = 0;
                $organismo = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo);
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo);
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo);
                }else{
                    $query;
                }
            }

        })->with(['liquidacionOrganismo','historia_laborales'])->paginate(10);
        
    }


        

    

    /**
     * busca liquidaciones segun su nombre o cuil.
     * 
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function agente(Request $request)
    {
        $nombre = $request->nombre;
        $cuil = $request->cuil;
        return Liquidacion::whereHas('historia_laborales', function($query) use ($nombre,$cuil){
            $query->whereHas('puesto', function($query2) use ($nombre,$cuil){
                $query2->whereHas('agente', function($query3) use ($nombre,$cuil){
                    if ($nombre != '') {
                        $query3->where('nombre','like',"%".$nombre."%");
                    } else if ($cuil != ''){
                        $query3->where('cuil','like',"%".$cuil."%");
                    }
                });
            });
        })->with(['liquidacionOrganismo','historia_laborales'])->paginate(10);
    }



    /**
     * aun no hace nada.
     * 
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function porOrigen(Request $request)
    {
        $periodo = $request->filtro->periodo;
        $tipo = $request->filtro->tipo_liquidacion;
        $organismo = $request->filtro->organismo;
        $jur = $request->filtro->jurisdiccion;
        $origen = $request->filtro->origen;
        return Liquidacion::whereHas('liquidacionOrganismo',function($query) use($periodo, $tipo, $organismo, $jur, $origen){

            if ($origen) {
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->whereHas('origen', function($query4) use ($periodo, $tipo, $organismo, $jur, $origen){
                                $query4->where('cod_origen' , $origen); 
                            });
                        });
                    });
                }
            } else if($jur) {
                $origen = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                       $query2->whereHas('jurisdiccion', function($query3) use ($periodo, $tipo, $organismo, $jur, $origen){
                            $query3->where('cod_jurisdiccion' , $jur); 
                        });
                    });
                }
            }else if($organismo){
                $origen = 0;
                $jur = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo)->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                }else{
                    $query->whereHas('organismo', function($query2) use ($periodo, $tipo, $organismo, $jur, $origen){
                        $query2->where('cod_organismo' , $organismo);
                    });
                }
            }else{
                $origen = 0;
                $jur = 0;
                $organismo = 0;
                if ($periodo && $tipo) {
                    $query->where('periodo_id',$periodo)->where('tipo_id',$tipo);
                } else if ($periodo && !$tipo ) {
                    $query->where('periodo_id',$periodo);
                } else if (!$periodo && $tipo) {
                    $query->where('tipo_id',$tipo);
                }else{
                    $query;
                }
            }

        })->with(['liquidacionOrganismo','historia_laborales'])->paginate(10);
        //return Liquidacion::whereHas('liquidacionOrganismo', function($query) use ($cod_origen){
        //    $query->whereHas('organismo', function($query2) use ($cod_origen){
                //$query2->whereHas('jurisdiccion', function($query3) use ($cod_origen){
                //    $query3->whereHas('origen', function($query4) use ($cod_origen){
                //        $query4->where('cod_origen' , $cod_origen); 
                //    });
                //});
        //    });
        //})->with(['liquidacionOrganismo','historia_laborales'])->paginate(10);
    }

}
        

        


