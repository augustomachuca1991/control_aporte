<?php

namespace App\Http\Controllers;

use App\Jurisdiccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JurisdiccionController extends Controller
{


    public $perPage = 10;
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

        $request->validate([
            'cod_jurisdiccion' => 'required|integer|unique:jurisdiccions,cod_jurisdiccion',
            'jurisdiccion' =>   'required|string|max:30',
            'origen_id' => 'required|exists:origens,cod_origen'
        ]);

        $jurisdiccion = Jurisdiccion::create([
            'cod_jurisdiccion' => $request->cod_jurisdiccion,
            'jurisdiccion' => $request->jurisdiccion,
            'origen_id' => $request->origen_id
        ]);

        return $jurisdiccion;
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


        $request->validate([
            'jurisdiccion' =>   'required|string|max:30',
            'origen_id' => 'required|exists:origens,cod_origen'
        ]);
        $jurisdiccion = Jurisdiccion::find($id);
        $jurisdiccion->update([
            'cod_jurisdiccion' => $request->cod_jurisdiccion,
            'jurisdiccion' => $request->jurisdiccion,
            'origen_id' => $request->origen_id
        ]);
        return $jurisdiccion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurisdiccion = Jurisdiccion::find($id);
        $hasOrganismos =  $jurisdiccion->organismos()->doesntExist();
        $hasCategorias =  $jurisdiccion->categorias()->doesntExist();
        if ($hasCategorias && $hasOrganismos) {
            $jurisdiccion->delete();
            $isValid = true;
            $msj = 'Jurisdicción eliminada satisfactoriamente';
        } else {
            $isValid = false;
            $msj = 'No es posible eliminar esta jurisdicción! Tiene asociado organismos y/o categorias';
        }

        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function getJurisdicciones()
    {
        return Jurisdiccion::with(['categorias', 'origen'])
            ->orderBy('id', 'DESC')
            ->paginate($this->perPage);
    }



    public function getAllJurisdicciones()
    {
        return Jurisdiccion::with(['categorias', 'origen'])->get();
    }
    /**
     * search the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        return Jurisdiccion::with(['categorias', 'origen'])
            ->where('jurisdiccion', 'LIKE', "%" . $search . "%")
            ->orWhere('cod_jurisdiccion', 'LIKE', "%" . $search . "%")
            ->paginate($this->perPage);
    }

    public function sort($column, $order)
    {
        return Jurisdiccion::with(['categorias', 'origen'])
            ->orderBy($column, $order)
            ->paginate($this->perPage);
    }


    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getJurisdicciones();
    }
}
