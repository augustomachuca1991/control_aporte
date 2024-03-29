<?php

namespace App\Http\Controllers;

use App\Agente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function show(Agente $agente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function edit(Agente $agente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agente $agente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agente $agente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function getAgentes()
    {
        return Agente::with('puestolaborales')->get();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    // public function search(Request $request)
    // {

    //     $data = ['cuil' => $request->cuil];
    //     $rules = ['cuil' => 'required|integer|exists:agentes,cuil|digits_between:10,11'];
    //     $message = [
    //         'cuil.integer' => 'Debe ingresar un tipo de cuil valido. Verifique ',
    //         'cuil.exists' => 'El cuil ingresado no existe en nuestra base de datos.',
    //         'cuil.digits_between' => 'digitos minimos 10 y max 11 (sin guiones)'
    //     ];
    //     $validator = Validator::make($data, $rules, $message);
    //     if ($validator->fails()) {
    //         return response()->json(['isError' => true, 'data' => $validator->errors()]);
    //     } else {
    //         $agentes = Agente::with('puestolaborales')->where('cuil', $request->cuil)->first();
    //         return response()->json(['isError' => false, 'data' => $agentes]);
    //     }
    // }

    public function porCuil($cuil)
    {
        $data = ['cuil' => $cuil];
        $rules = ['cuil' => 'required|integer|exists:agentes,cuil|digits_between:10,11'];
        $message = [
            'cuil.integer' => 'Debe ingresar un tipo de cuil valido. Verifique ',
            'cuil.exists' => 'El cuil ingresado no existe en nuestra base de datos.',
            'cuil.digits_between' => 'digitos minimos 10 y max 11 (sin guiones)',
            'cuil.required' => 'complete el campo'
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return response()->json(['isError' => true, 'data' => $validator->errors()]);
        } else {
            $agentes = Agente::with('organismos')->where('cuil', $cuil)->first();
            return response()->json(['isError' => false, 'data' => $agentes]);
        }
    }



    public function porPuesto($puesto)
    {



        $data = ['puesto_laboral' => $puesto];
        $rules = ['puesto_laboral' => 'required|integer|exists:agente_organismo,cod_laboral'];
        $message = [
            'puesto_laboral.integer' => 'El puesto laboral debe se un numero entero',
            'puesto_laboral.exists' => 'El puesto laboral ingresado no existe en nuestra base de datos.',
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return response()->json(['isError' => true, 'data' => $validator->errors()]);
        } else {
            $agentes = Agente::with('organismos')->whereHas('organismos', function ($organismos) use ($puesto) {
                $organismos->where('agente_organismo.cod_laboral', $puesto);
            })->first();
            return response()->json(['isError' => false, 'data' => $agentes]);
        }
    }

    public function autocomplete(Request $request)
    {
        $search = $request->search;
        $query = Agente::autocompleteAgente($search);
        return $query->with('puestolaborales')->get();
    }
}
