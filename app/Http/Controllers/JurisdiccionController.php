<?php

namespace App\Http\Controllers;

use App\Jurisdiccion;
use http\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return view('jurisdicciones.create', [
            'jurisdiccion' => new Jurisdiccion()
        ]);
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
            'cod_jurisdiccion'  =>  'required',
            'origen_id'       =>    'required,',
            'jurisdiccion'     =>  'required',
        ]);

        $form_data = array(
            'cod_jurisdiccion'       =>   $request->cod_jurisdiccion,
            'origen_id'       =>   $request->origen_id,
            'jurisdiccion'       =>   $request->jurisdiccion,
            'created_at'    =>   $date,
            'updated_at'       =>   $date
        );

        Jurisdiccion::create($form_data);

        return redirect()->route('jurisdicciones.index')->with('message', 'Jurisdicción creado satisfactoriamente');
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
        return view('jurisdicciones.show', [
            'jurisdiccion' => $jurisdiccion
        ]);
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
        dd($request);
        return view('jurisdicciones.edit', [
            'jurisdiccion' => $jurisdiccion
        ]);
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
        //
        $date = Carbon::now()->toDateTimeString();

        $validarDatos = $request->validate([
            'cod_jurisdiccion'  =>  'required',
            'origen_id'       =>    'required',
            'jurisdiccion'     =>  'required',
        ]);

        $form_data = array(
            'cod_jurisdiccion'       =>   $request->cod_jurisdiccion,
            'origen_id'       =>   $request->origen_id,
            'jurisdiccion'       =>   $request->jurisdiccion,
            'created_at'    =>   $date,
            'updated_at'       =>   $date
        );

        $jurisdiccion =Jurisdiccion::whereId($id)->update($form_data);

        return response()->json(['isValid'=>true,'errors'=>'Jurisdicción actualizado satisfactoriamente']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurisdiccion $jurisdiccion)
    {
        //
        $jurisdiccion->delete();

        return redirect()->route('jurisdicciones.index')->with('message', 'Jurisdicción eliminada satisfactoriamente');
    }

    public function jurisdiccion_json(Jurisdiccion $jurisdiccion)
    {
        return Jurisdiccion::with('categorias')->get();
    }
}
