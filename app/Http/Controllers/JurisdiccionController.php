<?php

namespace App\Http\Controllers;

use App\Jurisdiccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JurisdiccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$jurisdicciones = Jurisdiccion::paginate(10);
        //return view('jurisdicciones.index', [
        //    'jurisdicciones' => $jurisdicciones
        //]);

        return view('jurisdicciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('jurisdicciones.create', [
            //'jurisdiccion' => new Jurisdiccion()
        //]);
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
        // $date = Carbon::now()->toDateTimeString();

        // $validarDatos = $request->validate([
        //     'cod_jurisdiccion'  =>  'required',
        //     'origen_id'       =>    'required',
        //     'jurisdiccion'     =>  'required',
        // ]);
        // // dd($request->all());
        // try {

        //     $jur = Jurisdiccion::create([
        //         'cod_jurisdiccion'       =>   $request->cod_jurisdiccion,
        //         'origen_id'       =>   $request->origen_id,
        //         'jurisdiccion'       =>   $request->jurisdiccion,
        //         'created_at'    =>   $date,
        //     ]);
        //     return response()->json(['isValid'=>true,'errors'=>'Jurisdicción creada satisfactoriamente']);
        // }catch(\Exception $e) {
        //     return response()->json(['isValid'=>false,'errors'=>'Error al crear la Jurisdicción']);
        // }

        $validator = $request->validate([
            'cod_jurisdiccion' => 'required|integer|unique:jurisdiccions,cod_jurisdiccion',
            'jurisdiccion' =>   'required',
            'origen_id' => 'required'
        ]);

        if (!$validator) {
            return $validator;
        } else {
            $jurisdiccion = Jurisdiccion::create([
                'cod_jurisdiccion' => $request->cod_jurisdiccion,
                'jurisdiccion' => $request->jurisdiccion,
                'origen_id' => $request->origen_id
            ]);
            return $jurisdiccion;
        }


        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function show(Jurisdiccion $jurisdiccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Jurisdiccion $jurisdiccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $validator = Validator::make($request->all(), [
            'cod_jurisdiccion' => [
                'required',
                'integer',
                Rule::unique('jurisdiccions')->ignore($request->cod_jurisdiccion, 'cod_jurisdiccion')
            ],
            'jurisdiccion' => [
                'required'
            ],
        ]);
        if ($validator->fails()) {
            return $validator;
        } else {
            $jurisdiccion = Jurisdiccion::findOrfail($id);
            $jurisdiccion->update([
                'cod_jurisdiccion' => $request->cod_jurisdiccion,
                'jurisdiccion' => $request->jurisdiccion,
                'origen_id' => $request->origen_id
            ]);
            return $jurisdiccion;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $jurisdiccion = Jurisdiccion::find($id);
            $jurisdiccion->delete();
            return response()->json(['isValid'=>true,'errors'=>'Jurisdicción eliminada satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al eliminar la Jurisdicción']);
        }
    }

    public function getJurisdicciones(Jurisdiccion $jurisdiccion)
    {
        return Jurisdiccion::with(['categorias','origen'])->latest()->get();
    }

    public function search($search){

        try{
            //return $jur = Jurisdiccion::whereHas('origenes', function ($query) use ($id) {
                //$query->where('origen_id',(int)$id);
            ////})->get();
            return Jurisdiccion::with(['categorias','origen'])
            ->where('jurisdiccion' ,'LIKE' ,"%".$search."%")
            ->orWhere('cod_jurisdiccion' ,'LIKE' ,"%".$search."%")
            ->get();
        }catch (\Exception $e){
            return [];
        }

    }
}
