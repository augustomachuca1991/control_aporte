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
    public function search($cuil)
    {
        //$cuil->validate();
         $data = ['cuil' => $cuil];
         $rules = ['cuil' => 'integer|exists:agentes,cuil'];
         //$rules = ['cuil' => 'required|integer|exists:agentes,cuil'];
        $validator = Validator::make($data,$rules);

        //$validator = $data->validate(['required|integer']);

        if (!$validator) {
            return $validator;
        }else{

            return Agente::with('puestolaborales')->where('cuil' , $cuil)->get();
        }
    }


}
