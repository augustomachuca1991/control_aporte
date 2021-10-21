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
        //
        return view('organismos.index');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organismo = Organismo::with(['jurisdiccion'])
            ->where('id', $id)->first();
        return $organismo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function edit(Organismo $organismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // //
        // $date = Carbon::now()->toDateTimeString();

        // $validarDatos = $request->validate([
        //     'cod_organismo'  =>  'required',
        //     'jurisdiccion_id'       =>    'required',
        //     'organismo'     =>  'required',
        // ]);

        // $form_data = array(
        //     'cod_organismo'       =>   $request->cod_organismo,
        //     'jurisdiccion_id'       =>   $request->jurisdiccion_id,
        //     'organismo'       =>   $request->organismo,
        //     'updated_at'       =>   $date
        // );

        // try {
        //     $organismo = Organismo::whereId($id)->update($form_data);
        //     return response()->json(['isValid'=>true,'errors'=>'Organismo actualizado satisfactoriamente']);
        // }catch(\Exception $e) {
        //     return response()->json(['isValid'=>false,'errors'=>'Error al actualizar el Organismo']);
        // }

        $validator = $request->validate([
            'jurisdiccion_id' => 'required|integer',
            'organismo' => 'required',
        ]);

        if (!$validator) {
            return $validator;
        } else {
            $organismo = Organismo::find($id);
            $organismo->jurisdiccion_id = $request->jurisdiccion_id;
            $organismo->organismo = $request->organismo;
            $organismo->updated_at = now();
            $organismo->save();
            return $this->show($organismo->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function getOrganismos()
    {
        return Organismo::with(['jurisdiccion'])->orderBy('id', 'DESC')->paginate($this->perPage);
    }






    public function getAllOrganismos()
    {
        return Organismo::with(['jurisdiccion'])->get();
    }

    /**
     * search the specified resource from storage.
     *
     * @param  \App\Jurisdiccion  $jurisdiccion
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {

        try {
            return Organismo::with(['jurisdiccion'])
                ->where('organismo', 'LIKE', "%" . $search . "%")
                ->orWhere('cod_organismo', 'LIKE', "%" . $search . "%")
                ->paginate($this->perPage);
        } catch (\Exception $e) {
            return 'algo salio mal';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function sort($column, $order)
    {

        try {

            return Organismo::with(['jurisdiccion'])
                ->orderBy($column, $order)
                ->paginate($this->perPage);
        } catch (\Exception $e) {
            return 'algo salio mal';
        }
    }
}
