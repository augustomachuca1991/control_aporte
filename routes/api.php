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
Route::get('/organismo', 'OrganismoController@index')->name('organismo');

//liquidaciones
Route::get('/liquidacion', 'LiquidacionController@getliquidaciones')->name('liquidacion');
Route::get('/liquidacion/origen/{origen?}/jurisdiccion/{jur?}/organismo/{organismo?}/periodo/{periodo?}/tipo/{tipo?}', 'LiquidacionController@filtro')->name('filtro');
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


// Categoria

Route::get('/categoria/{id}', 'CategoriaController@getCategorias')->name('categoria');
Route::get('/categoria/edit/{id}', 'CategoriaController@edit')->name('edit_categoria');
Route::put('/categoria/update/{id}', 'CategoriaController@update')->name('update_categoria');
Route::post('/categoria/create', 'CategoriaController@store')->name('create_categoria');
Route::delete('/categoria/delete/{id}', 'CategoriaController@destroy')->name('delete_categoria');

Route::get('/clase', 'ClaseController@getClases')->name('clases');
Route::get('/clase/edit/{id}', 'ClaseController@edit')->name('edit_clase');
Route::put('/clase/update/{id}', 'ClaseController@update')->name('update_clase');
Route::post('/clase/create', 'ClaseController@store')->name('create_clase');
Route::delete('/clase/delete/{id}', 'ClaseController@destroy')->name('delete_clase');

// Jurisdicciones
Route::get('/jurisdiccion', 'JurisdiccionController@jurisdiccion_json')->name('jurisdiccion');
Route::get('/jurisdiccion/{id}', 'JurisdiccionController@jurisdiccion_json')->name('jurisdiccion');
Route::get('/jurisdiccion/edit/{id}', 'JurisdiccionController@edit')->name('edit_jurisdiccion');
Route::put('/jurisdiccion/update/{id}', 'JurisdiccionController@update')->name('update_jurisdiccion');
Route::post('/jurisdiccion/create', 'JurisdiccionController@store')->name('create_jurisdiccion');
Route::delete('/jurisdiccion/delete/{id}', 'JurisdiccionController@destroy')->name('delete_jurisdiccion');
