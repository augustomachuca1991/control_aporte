<?php

namespace App\Http\Controllers;

use App\Organismo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        
        $validator = $request->validate([
            'cod_organismo' => 'required|integer|unique:organismos,cod_organismo',
            'organismo' =>   'required',
            'jurisdiccion_id' => 'required',
            'origen_id' => 'required'
        ]);
        if (!$validator) {
            return $validator;
        } else {
            $organismo = Organismo::create([
                'cod_organismo' => $request->cod_organismo,
                'organismo' => $request->organismo,
                'jurisdiccion_id' => $request->jurisdiccion_id
            ]);
            return $organismo;
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
            $organismo = Organismo::findOrFail($id);
            $organismo->delete();
            return response()->json(['isValid'=>true,'errors'=>'organismo eliminada satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al eliminar la organismo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function getOrganismos()
    {
        return Organismo::with(['jurisdiccion'])->latest()->get();
    }

    /**
     * search the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {

        try{
            return Organismo::with(['jurisdiccion'])
            ->where('organismo' ,'LIKE' ,"%".$search."%")
            ->orWhere('cod_organismo' ,'LIKE' ,"%".$search."%")
            ->get();
        }catch (\Exception $e){
            return 'algo salio mal';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function sort($column , $order){

        try{
            
            return Organismo::with(['jurisdiccion'])
            ->orderBy($column, $order)
            ->get();
        }catch (\Exception $e){
            return 'algo salio mal';
        }

    }
}
