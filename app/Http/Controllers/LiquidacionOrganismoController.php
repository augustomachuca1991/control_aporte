<?php

namespace App\Http\Controllers;

use App\LiquidacionOrganismo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionOrganismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('computos.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function show(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function edit(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiquidacionOrganismo  $liquidacionOrganismo
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiquidacionOrganismo $liquidacionOrganismo)
    {
        //
    }

    public function ComputoOrigenes($periodo){
        
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)->whereHas('organismo', function($query){
            $query->whereHas('jurisdiccion',function($query2){
                $query2->whereHas('origen',function($query3){
                    $query3;
                });
            });
        })->with(['organismo','periodo','tipoliquidacion'])
        ->get();
        return $computos;
    }

    public function ComputoJurisdicciones($periodo){
        
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)->whereHas('organismo', function($query){
            $query->whereHas('jurisdiccion',function($query2){
                $query2;
            });
        })->with('organismo')->get()->groupBy('organismo.jurisdiccion.jurisdiccion');
        return $computos;
    }

    public function ComputoOrganismos($periodo){
        
        $computos = LiquidacionOrganismo::where('periodo_id', $periodo)->whereHas('organismo', function($query){
            $query;
        })->with('organismo')->get()->groupBy('organismo.organismo');
        return $computos;
    }
}
