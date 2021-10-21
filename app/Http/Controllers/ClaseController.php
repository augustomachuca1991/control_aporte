<?php

namespace App\Http\Controllers;

use App\Clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{

    public $perPage = 10;







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
        $request->validate([
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
            'clase' => 'required|string|max:30',
            'categoria_id' => 'required|exists:categorias,cod_categoria'
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


        $clase = Clase::find($id);
        $hasPuestosLaborales =  $clase->puestolaborales()->doesntExist();
        if ($hasPuestosLaborales) {
            $isValid = true;
            $msj = "Clase '" . $clase->clase . "' eliminada";
            $clase->puestolaborales()->detach();
            $clase->forceDelete();
        } else {
            $isValid = false;
            $msj = 'No es posible eliminar esta clase! Esta asociado a una o varias puesto laboral/es';
        }


        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }

    public function getClases()
    {
        return Clase::with('categoria')->orderBy('id', 'DESC')->paginate($this->perPage);
    }



    public function getAllClases()
    {
        return Clase::with('categoria')->get();
    }


    public function search($search)
    {


        return Clase::with(['categoria'])
            ->where('clase', 'LIKE', "%" . $search . "%")
            ->orWhere('cod_clase', 'LIKE', "%" . $search . "%")
            ->orWhereHas('categoria', function ($query) use ($search) {
                $query->where('categoria', 'LIKE', "%" . $search . "%");
            })
            ->paginate($this->perPage);
    }




    public function sort($column, $order)
    {

        return Clase::with(['categoria'])
            ->orderBy($column, $order)
            ->paginate($this->perPage);
    }



    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getClases();
    }
}
