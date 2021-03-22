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
            'id_jurisdiccion'   => 'required',
            'cod_categoria'     => 'required|unique:categorias',
            'categoria'         => 'required|string',
        ]);
        // dd($validarDatos);
        $categoria = Categoria::create([
                                        'cod_categoria' => $request->cod_categoria,
                                        'categoria'     => $request->categoria
                                        ]);
        // dd($categoria);
        $id_jurisdiccion = $request->id_jurisdiccion;
        // dd($cod_jurisdiccion);
        $categoria->jurisdicciones()->attach($id_jurisdiccion);

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
        // dd($request->all());
        $categoria =  Categoria::find($id);
        // dd($categoria);

        $categoria->categoria = $request['categoria'];
        $categoria->updated_at = now();
        $categoria->save();
        $jur_id = $categoria->jurisdicciones->first()->id;

        $categorias = $this->getCategorias($jur_id);
        return $categorias;
       
      
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
        $j_id = $categoria->jurisdicciones->first()->pivot->jurisdiccion_id;
        $categoria->delete();

        return $this->getCategorias($j_id);
    }

    public function getCategorias(){
        return Categoria::all();
    }
    public function getCategoria($id){
        $categoria =  Categoria::find($id);
        $j_id = $categoria->jurisdicciones->first()->pivot->jurisdiccion_id;
        $o_id = $categoria->jurisdicciones->first()->origen_id;

        return [
            'jurisdiccion_id' => $j_id,
            'origen_id' => $o_id
        ];
    }
}
