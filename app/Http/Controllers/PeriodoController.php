<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{


    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('periodos.index');
    }




    public function store(Request $request)
    {
        $request->validate([
            'cod_periodo' => 'required|integer|unique:periodos,cod_periodo',
            'mes' => 'required|integer|between:1,12',
            'anio' => 'required|integer',
            'periodo' => 'required|string|max:30',
        ]);

        $periodo = Periodo::create([
            'cod_periodo' => $request->cod_periodo,
            'periodo' => $request->periodo,
            'mes' => $request->mes,
            'anio' => $request->anio,
        ]);

        return $this->show($periodo->id);
    }




    public function show($id)
    {
        return Periodo::find($id);
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'cod_periodo' => 'required',
            'mes' => 'required|integer|between:1,12',
            'anio' => 'required|integer',
            'periodo' => 'required|string|max:30',
        ]);

        $periodo =  Periodo::find($id);
        $periodo->cod_periodo = $request->cod_periodo;
        $periodo->mes = $request->mes;
        $periodo->anio = $request->anio;
        $periodo->periodo = $request->periodo;
        $periodo->updated_at = now();
        $periodo->save();

        return $this->show($periodo->id);
    }




    public function destroy($id)
    {
        $periodo = Periodo::where('id', $id)->first();
        $hasLiquidaciones =  $periodo->liquidaciones()->doesntExist();
        $hasComputos =  $periodo->liquidacionOrganismo()->doesntExist();
        $hasOrganismos =  $periodo->organismos()->doesntExist();
        if ($hasLiquidaciones && $hasComputos && $hasOrganismos) {
            $msj = 'periodo ' . $periodo->periodo . ' eliminado satisfactoriamente';
            $isValid = true;
            $periodo->delete();
        } else {
            $isValid = false;
            $msj = 'No es posible eliminar este periodo! esta asociado a varios datos y podria causar una problema al sistemas';
        }

        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }

    public function getPeriodos()
    {

        return Periodo::latest()->paginate($this->perPage);
    }



    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getPeriodos();
    }


    public function search($search)
    {
        return Periodo::filtroPeriodo($search)
            ->paginate($this->perPage);
    }



    public function sort($column, $order)
    {

        return Periodo::orderBy($column, $order)
            ->paginate($this->perPage);
    }
}
