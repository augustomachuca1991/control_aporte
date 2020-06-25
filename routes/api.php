<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/origen', 'OrigenController@index')->name('origen');
Route::get('/jurisdiccion', 'JurisdiccionController@jurisdiccion_json')->name('jurisdiccion');
Route::get('/organismo', 'OrganismoController@index')->name('organismo');
Route::get('/categoria', 'CategoriaController@categoria_json')->name('categoria');

//liquidaciones
Route::get('/liquidacion', 'LiquidacionController@getliquidaciones')->name('liquidacion');
Route::get('/liquidacion/detalle/{id}', 'LiquidacionController@show')->name('liquidacion');

//puesto laborales
Route::get('/puesto', 'PuestoLaboralController@getpuestoLaboral')->name('puesto_laboral');

//conceptos
Route::get('/concepto', 'ConceptoLiquidacionController@getConcepto')->name('concepto');

//subtipos codigos
Route::get('/subtipo', 'SubtipoCodigoController@getSubtipo')->name('subtipo');

//tipos de codigos
Route::get('/tipocodigo', 'TipoCodigoController@getTipo')->name('tipocodigo');

//tipos de liquidaciones
Route::get('/tipoliquidacion', 'TipoLiquidacionController@getTipoLiquidacion')->name('tipoliquidacion');

//periodos
Route::get('/periodo', 'PeriodoController@getPeriodo')->name('periodo');