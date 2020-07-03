<?php

namespace App\Http\Controllers;

use App\Clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validarDatos = $request->validate([
            'categoria_id' => 'required',
            'clase'     => 'required|string',
        ]);

        $clase = Clase::create([
                                'categoria_id' => $request['categoria_id'],
                                'clase'     => $request['clase']
                                ]);
        // return back()->withSuccess('Clase creada con éxito');
        return Clase::where('categoria_id','=',$request->categoria_id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(Clase $clase)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Clase::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'clase'     => 'required'
        ]);

        $clase =  Clase::find($id);

        $clase->categoria_id = $request['categoria_id'];
        $clase->clase = $request['clase'];
        $clase->updated_at = now();
        $clase->save();

        return $clase;
       
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clase = Clase::find($id);

        $categoria_id = $clase->categoria->id;

        $clase->delete();
        // $categoria_id = $
        return $this->getClases($categoria_id);
    }

    public function getClases($id){
        return Clase::where('categoria_id','=',$id)->get();
    }
}
