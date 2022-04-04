<?php

namespace App\Http\Controllers;

use App\PuestoLaboral;
use Illuminate\Http\Request;

class PuestoLaboralController extends Controller
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
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function show(PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function edit(PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuestoLaboral $puestoLaboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuestoLaboral  $puestoLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuestoLaboral $puestoLaboral)
    {
        //
    }

    public function getpuestoLaboral()
    {
        return PuestoLaboral::with('clases')->get();
    }

    public function getPuestoLaboralSelected($id)
    {
        try {
            return PuestoLaboral::with('agente')->where('organismo_id', $id)->get();
        } catch (\Exception $e) {
            return [];
        }
    }


    // public function autocomplete(Request $request)
    // {
    //     $search = $request->search;

    //     //validate
    //     // $query = PuestoLaboral::where('cod_laboral',$search)->with('agente')->get();
    //     // return $query;



    //     $query = PuestoLaboral::where('cod_laboral', $search)
    //         ->whereHas('agente', function ($agente) use ($search) {
    //             $agente->where('cuil', 'LIKE', "%" . $search . "%")->orWhere('nombre', 'LIKE', "%" . $search . "%");
    //         })->get();
    //     return $query;
    // }
}
