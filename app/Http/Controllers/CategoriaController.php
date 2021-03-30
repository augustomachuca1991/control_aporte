<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    
    public $perPage = 15;
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
            'cod_categoria'     => 'required|unique:categorias',
            'categoria'         => 'required|string',
            'jurisdiccion_id'   => 'required',
        ]);
        // dd($validarDatos);
        $categoria = Categoria::create([
                                        'cod_categoria' => $request->cod_categoria,
                                        'categoria'     => $request->categoria
                                        ]);
        // dd($categoria);
        $categoria->jurisdicciones()->attach($request->jurisdiccion_id);

        return $this->show($categoria->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::with(['jurisdicciones'])
                ->where('id', $id)->first();
        return $categoria;
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

        $categoria->categoria = $request->categoria;
        $categoria->updated_at = now();
        $categoria->save();
        return $this->show($categoria->id);
       
      
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
        $nombre_categoria = $categoria->categoria;
        foreach($categoria->clases as $clases)
        {
            $clases->delete();
        };
        $categoria->jurisdicciones()->detach();
        $categoria->delete();

        return $nombre_categoria." borrado exitosamente";
    }

    public function getCategorias(){
        return Categoria::with('jurisdicciones')->paginate($this->perPage);
    }


    public function getAllCategorias(){
        return Categoria::with('jurisdicciones')->get();
    }


    public function search($search)
    {

        
            return Categoria::with(['jurisdicciones'])
            ->where('categoria' ,'LIKE' ,"%".$search."%")
            ->orWhere('cod_categoria' ,'LIKE' ,"%".$search."%")
            ->orWhereHas('jurisdicciones' , function($query) use ($search){
                $query->where('jurisdiccion','LIKE',"%".$search."%");
            })
            ->paginate($this->perPage);

    }




    public function sort($column , $order)
    {
            
            return 
            Categoria::with(['jurisdicciones'])
            ->orderBy($column, $order)
            ->paginate($this->perPage);

    }
}
