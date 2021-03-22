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
        $validar = $request->validate([
            'cod_clase' => 'required|integer',
            'clase' => 'required|string',
            'categoria_id' => 'required',
        ]);

        $clase = Clase::create([
            'cod_clase' => $request->cod_clase,
            'clase' => $request->clase,
            'categoria_id' => $request->categoria_id,
        ]);

        return $this->show($clase->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clase = Clase::with(['categoria'])
                ->where('id', $id)->first();
        return $clase;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return Clase::find($id);
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
            //'cod_clase'     => 'required',
            'clase' => 'required|string',
            'categoria_id' => 'required',
        ]);

        $clase =  Clase::find($id);
        $clase->categoria_id = $request->categoria_id;
        $clase->clase = $request->clase;
        $clase->updated_at = now();
        $clase->save();

        return $this->show($clase->id);
       
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //tambien se debe borrar la categoria relacionada a esa clase
        $clase = Clase::find($id);
        $nombre_clase = $clase->clase;
        $clase->delete();
        return $nombre_clase.' Borrado correctamente';
    }

    public function getClases(){
        return Clase::with('categoria')->latest()->get();
    }


    public function search($search)
    {

        
            return Clase::with(['categoria'])
            ->where('clase' ,'LIKE' ,"%".$search."%")
            ->orWhere('cod_clase' ,'LIKE' ,"%".$search."%")
            ->orWhereHas('categoria' , function($query) use ($search){
                $query->where('categoria','LIKE',"%".$search."%");
            })
            ->get();

    }




    public function sort($column , $order)
    {
            
            return Clase::with(['categoria'])
            ->orderBy($column, $order)
            ->get();

    }



}
