<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categorias.index');
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
        // dd($request->all());
        $validarDatos = $request->validate([
            'cod_jurisdiccion'  => 'required',
            'cod_categoria'     => 'required|numeric',
            'categoria'         => 'required|string',
        ]);

        $categoria = Categoria::create([
                                        'cod_categoria' => $request['cod_categoria'],
                                        'categoria'     => $request['categoria']
                                        ]);
        $cod_jurisdiccion = $request->cod_jurisdiccion;
        $categoria->jurisdicciones()->attach($cod_jurisdiccion);
        return $categoria;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Categoria::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria'     => 'required'
        ]);

        $categoria =  Categoria::find($id);

        $categoria->categoria = $request['categoria'];
        $categoria->updated_at = now();
        $categoria->save();

        return $categoria;
       
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return back()->withSuccess('Categoria eliminada con éxito');
    }

    public function get_categorias(){
        return Categoria::all();
    }
}
