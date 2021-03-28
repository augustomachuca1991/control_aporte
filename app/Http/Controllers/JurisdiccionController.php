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
        return view('jurisdicciones.index');
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
            foreach ($jurisdiccion->organismos as $organismos) {
                $organismos->delete();
            }
            $jurisdiccion->delete();
            return response()->json(['isValid'=>true,'errors'=>'Jurisdicción eliminada satisfactoriamente']);
        }catch(\Exception $e) {
            return response()->json(['isValid'=>false,'errors'=>'Error al eliminar la Jurisdicción']);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function getJurisdicciones(Jurisdiccion $jurisdiccion)
    {
        return Jurisdiccion::with(['categorias','origen'])->paginate(10);
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
            return Jurisdiccion::with(['categorias','origen'])
            ->where('jurisdiccion' ,'LIKE' ,"%".$search."%")
            ->orWhere('cod_jurisdiccion' ,'LIKE' ,"%".$search."%")
            ->get();
        }catch (\Exception $e){
            return 'algo salio mal';
        }

    }

    public function sort($column , $order)
    {

        try{
            
            return Jurisdiccion::with(['categorias','origen'])
            ->orderBy($column, $order)
            ->get();
        }catch (\Exception $e){
            return 'algo salio mal';
        }

    }
}
