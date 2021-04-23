<?php

namespace App\Http\Controllers;

use App\HistoriaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoriaLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('historia_laborales.index');
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
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriaLaboral $historiaLaboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoriaLaboral  $historiaLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriaLaboral $historiaLaboral)
    {
        //
    }

    public function getHistoriaLaborales(HistoriaLaboral $historiaLaboral)
    {
        try{
            return HistoriaLaboral::with('agente')->get();
        }catch (\Exception $e){
            return [];
        }
    }
    

    public function search_puesto($search)
    {
        
        $data = ['puesto_laboral' => $search];
        $rules = ['puesto_laboral' => 'required|integer|exists:agente_organismo,cod_laboral'];
        $message = ['puesto_laboral.integer' => 'Debe ingresar un codigo de puesto laboral válido',
                    'puesto_laboral.exists' => 'EL puesto laboral no existe. Verifique',
                    'puesto_laboral.required' => 'Debe completar el campo'];
        $validator = Validator::make($data,$rules,$message);
        if ($validator->fails()) {
            return response()->json(['isError' => true ,'data' => $validator->errors()]);
        }else{
            $historialaboral = HistoriaLaboral::buscarPorPuesto($search)->first();
            return response()->json(['isError' => false ,'data' => $historialaboral]);
        }
        
    }


    public function search_cuil($search)
    {
        // return HistoriaLaboral::whereHas('puesto', function($puestos) use ($search){
        //     $puestos->where('cod_laboral',$search);
        // })->with('puesto')->first();
        $data = ['cuil' => $search];
        $rules = ['cuil' => 'required|integer|exists:agentes,cuil'];
        $message = ['cuil.integer' => 'Debe ingresar solo cuil numerico sin guiones',
                    'cuil.exists' => 'EL cuil ingresado no existe en nuestros registros. Verifique',
                    'cuil.required' => 'Debe completar el campo'];
        $validator = Validator::make($data,$rules,$message);
        if ($validator->fails()) {
            return response()->json(['isError' => true ,'data' => $validator->errors()]);
        }else{
            $historialaboral = HistoriaLaboral::buscarPorCuil($search)->first();
            return response()->json(['isError' => false ,'data' => $historialaboral]);
        }
        
    }

    public function puestoHistoriaLaboralSelected($id){
        try{

            return HistoriaLaboral::with('clase','puesto')->where('puesto_id',$id)->get();
            //return HistoriaLaboral::find('puesto_id',$id)->get();
        }catch (\Exception $e){
            return [];
        }
    }

}
