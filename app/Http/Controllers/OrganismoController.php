<?php

namespace App\Http\Controllers;

use App\Organismo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrganismoController extends Controller
{


    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organismos.index');
    }


    public function store(Request $request)
    {

        $request->validate([
            'cod_organismo' => 'required|integer|unique:organismos,cod_organismo',
            'organismo' =>   'required|string|max:30',
            'jurisdiccion_id' => 'required|exists:jurisdiccions,cod_jurisdiccion',
        ]);

        $organismo = Organismo::create([
            'cod_organismo' => $request->cod_organismo,
            'organismo' => $request->organismo,
            'jurisdiccion_id' => $request->jurisdiccion_id
        ]);

        return $this->show($organismo->id);
    }


    public function show($id)
    {
        return Organismo::with(['jurisdiccion'])
            ->where('id', $id)->first();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'cod_organismo' => 'required|integer',
            'jurisdiccion_id' => 'required|exists:jurisdiccions,cod_jurisdiccion',
            'organismo' => 'required|string|max:30',
        ]);


        $organismo =  Organismo::find($id);

        $organismo->cod_organismo = $request->cod_organismo;
        $organismo->organismo = $request->organismo;
        $organismo->jurisdiccion_id = $request->jurisdiccion_id;
        $organismo->updated_at = now();
        $organismo->save();

        return $this->show($organismo->id);
    }


    public function destroy($id)
    {
        $organismo = Organismo::find($id);
        $hasLiquidaciones =  $organismo->liquidaciones()->doesntExist();
        $hasAgentes =  $organismo->agentes()->doesntExist();
        $hasConceptos =  $organismo->conceptos()->doesntExist();
        $hasEstados =  $organismo->estados()->doesntExist();
        if ($hasLiquidaciones && $hasAgentes && $hasConceptos && $hasEstados) {
            $organismo->delete();
            $isValid = true;
            $msj = 'Organismo eliminada satisfactoriamente';
        } else {
            $isValid = false;
            $msj = 'No es posible eliminar este Organismo! esta asociado a varios datos y podria causar una problema al sistemas';
        }

        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }



    public function getOrganismos()
    {
        return Organismo::with(['jurisdiccion'])->orderBy('id', 'DESC')->paginate($this->perPage);
    }



    public function getAllOrganismos()
    {
        return Organismo::with(['jurisdiccion'])->get();
    }



    public function search($search)
    {

        return Organismo::searchOrganismo($search)->with('jurisdiccion')->paginate($this->perPage);
    }




    public function sort($column, $order)
    {
        return Organismo::with(['jurisdiccion'])
                ->orderBy($column, $order)
                ->paginate($this->perPage);
    }


    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getOrganismos();
    }
}
