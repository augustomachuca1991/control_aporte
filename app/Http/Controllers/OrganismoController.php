<?php

namespace App\Http\Controllers;

use App\Organismo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrganismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('organismos.index');
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
        $date = Carbon::now()->toDateTimeString();

        $validarDatos = $request->validate([
            'cod_organismo'  =>  'required',
            'jurisdiccion_id'       =>    'required',
            'organismo'     =>  'required',
        ]);

        try {

            $org = Organismo::create([
                'cod_organismo'       =>   $request->cod_organismo,
                'jurisdiccion_id'       =>   $request->jurisdiccion_id,
                'organismo'       =>   $request->organismo,
                'created_at'    =>   $date,
            ]);

            return response()->json(['isValid'=>true,'errors'=>'Organismo creado satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al crear la Organismo']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function show(Organismo $organismo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function edit(Organismo $organismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $date = Carbon::now()->toDateTimeString();

        $validarDatos = $request->validate([
            'cod_organismo'  =>  'required',
            'jurisdiccion_id'       =>    'required',
            'organismo'     =>  'required',
        ]);

        $form_data = array(
            'cod_organismo'       =>   $request->cod_organismo,
            'jurisdiccion_id'       =>   $request->jurisdiccion_id,
            'organismo'       =>   $request->organismo,
            'updated_at'       =>   $date
        );

        try {
            $organismo = Organismo::whereId($id)->update($form_data);
            return response()->json(['isValid'=>true,'errors'=>'Organismo actualizado satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al actualizar el Organismo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $organismo = Organismo::find($id);
            $organismo->delete();
            return response()->json(['isValid'=>true,'errors'=>'Organismo eliminado satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al eliminar el Organismo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function getOrganismos(Organismo $organismo)
    {
        try{
        return Organismo::with('jurisdiccion')->get();
        }catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function getJurisdiccionesSelected($id){
        try{
            return Organismo::with('jurisdiccion')->where('jurisdiccion_id',$id)->get();
        }catch (\Exception $e){
            return [];
        }
    }
}
