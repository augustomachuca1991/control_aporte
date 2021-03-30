<?php

namespace App\Http\Controllers;

use App\Origen;
use Illuminate\Http\Request;

class OrigenController extends Controller
{
    
    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Origen::with('Jurisdicciones')->get();
        //return Origen::with('jurisdiccionOrganismo')->get();
        //return Origen::all();
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
     * @param  \App\Origen  $origen
     * @return \Illuminate\Http\Response
     */
    public function show(Origen $origen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Origen  $origen
     * @return \Illuminate\Http\Response
     */
    public function edit(Origen $origen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Origen  $origen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Origen $origen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Origen  $origen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origen $origen)
    {
        //
    }




    public function getOrigenes()
    {
        
        return Origen::with('Jurisdicciones')->paginate($this->perPage);
    }



    public function getAllOrigenes()
    {
        return Origen::with('Jurisdicciones')->get();
    }
}
