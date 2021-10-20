<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\Liquidacion;
use App\LiquidacionOrganismo;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{


    protected $perPage = 10;
    protected $liquidaciones;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liquidaciones.index');
    }

    /**
     * Muestra una liquidacion especifica con su respectivo detalle.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $liquidacion = Liquidacion::where('id', $id)
            ->with(['liquidacionOrganismo', 'historia_laborales', 'detalles'])
            ->first();
        foreach ($liquidacion->detalles as $detalle) {
            switch ($detalle->concepto->subtipo->tipocodigo->id) {
                case 1:
                    $liquidacion->bruto += $detalle->importe;
                    break;
                case 2:
                    $liquidacion->bonificable += $detalle->importe;
                    break;
                case 3:
                    $liquidacion->no_bonificable += $detalle->importe;
                    break;
                case 4:
                    $liquidacion->no_remunerativo += $detalle->importe;
                    break;
                case 5:
                    $liquidacion->familiar += $detalle->importe;
                    break;
                case 6:
                    $liquidacion->descuento += $detalle->importe;
                    break;

                default:
                    break;
            }
        }
        return $liquidacion;
    }

    

    /**
     * obtener todas las liquidaciones almacenadas.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function getliquidaciones()
    {
        return LiquidacionOrganismo::with(['organismo', 'liquidacion', 'tipoliquidacion', 'periodo'])->paginate($this->perPage);
    }
    


    public function search($search)
    {
        return LiquidacionOrganismo::buscarLiquidacion($search)
            ->with(['organismo', 'liquidacion', 'tipoliquidacion', 'periodo'])
            ->paginate($this->perPage);
    }


    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->filter;
    }


    public function hl()
    {
        return Liquidacion::with('historia_laborales')->paginate($this->perPage);
    }

    public function secuencia()
    {

        return LiquidacionOrganismo::liquidacionesRectificadas()->paginate($this->perPage);
    }


    public function filter(Request $request)
    {
        
        return LiquidacionOrganismo::filtroLiquidacion($request->all())
        ->with(['organismo', 'liquidacion', 'tipoliquidacion', 'periodo'])->paginate($this->perPage);

        
    }
}
