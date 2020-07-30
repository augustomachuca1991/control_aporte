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



//Declaraciones Juradas
Route::get('declaracion_jurada' , 'DeclaracionJuradaController@getDeclaracionesJuradas');

//Declaraciones Juradas detalle
Route::get('declaracion_jurada/detalle/{id}' , 'DeclaracionJuradaLineController@show');

//Computos
Route::get('/computo/origen/{periodo}', 'LiquidacionOrganismoController@computoOrigenes');
Route::get('/computo/jurisdiccion/{periodo}', 'LiquidacionOrganismoController@ComputoJurisdicciones');
Route::get('/computo/organismo/{periodo}', 'LiquidacionOrganismoController@ComputoOrganismos');



//liquidaciones
Route::get('/liquidacion', 'LiquidacionController@getliquidaciones')->name('liquidacion');
Route::get('/liquidacion/detalle/{id}', 'LiquidacionController@show')->name('liquidacion_detalle');
Route::post('/liquidacion/agente/filtro','LiquidacionController@agente')->name('filtros');
Route::post('/liquidacion/filtro','LiquidacionController@filtro')->name('buscar');

//Files Routes
Route::post('/import', 'ExcelController@import')->name('import');
Route::post('/export', 'ExcelController@export')->name('export');


//Puestos Laborales
Route::get('/puesto', 'PuestoLaboralController@getpuestoLaboral')->name('puesto_laboral');
// agente_organismo
Route::get('/agente_organismo', 'PuestoLaboralController@index')->name('puesto_laboral');
Route::get('/agente_organismo/{id}', 'PuestoLaboralController@getPuestoLaboralSelected')->name('puesto_laboral');
Route::get('/agente_organismo/edit/{id}', 'PuestoLaboralController@edit')->name('edit_puesto_laboral');
Route::put('/agente_organismo/update/{id}', 'PuestoLaboralController@update')->name('update_puesto_laboral');
Route::post('/agente_organismo/create', 'PuestoLaboralController@store')->name('create_puesto_laboral');
Route::delete('/agente_organismo/delete/{id}', 'PuestoLaboralController@destroy')->name('delete_puesto_laboral');


//Conceptos
Route::get('/concepto', 'ConceptoLiquidacionController@getConcepto')->name('concepto');

//Subtipos Codigos
Route::get('/subtipo', 'SubtipoCodigoController@getSubtipo')->name('subtipo');

//Tipos  Codigos
Route::get('/tipocodigo', 'TipoCodigoController@getTipo')->name('tipocodigo');

//Tipos Liquidaciones
Route::get('/tipoliquidacion', 'TipoLiquidacionController@getTipoLiquidacion')->name('tipoliquidacion');

//Periodos
Route::get('/periodo', 'PeriodoController@getPeriodo')->name('periodo');
Route::get('/periodo/{id}', 'PeriodoController@show');

// Categoria
Route::get('/categoria/find/{id}', 'CategoriaController@getCategoria')->name('find_categoria');
Route::get('/categoria/{id}', 'CategoriaController@getCategorias')->name('categoria');
Route::get('/categoria/edit/{id}', 'CategoriaController@edit')->name('edit_categoria');
Route::put('/categoria/update/{id}', 'CategoriaController@update')->name('update_categoria');
Route::post('/categoria/create', 'CategoriaController@store')->name('create_categoria');
Route::delete('/categoria/delete/{id}', 'CategoriaController@destroy')->name('delete_categoria');

// Clases
Route::get('/clase/{id}', 'ClaseController@getClases')->name('clases');
Route::get('/clase/edit/{id}', 'ClaseController@edit')->name('edit_clase');
Route::put('/clase/update/{id}', 'ClaseController@update')->name('update_clase');
Route::post('/clase/create', 'ClaseController@store')->name('create_clase');
Route::delete('/clase/delete/{id}', 'ClaseController@destroy')->name('delete_clase');

// Jurisdicciones
Route::get('/jurisdiccion', 'JurisdiccionController@jurisdiccion_json')->name('jurisdiccion');
Route::get('/jurisdiccion/{id}', 'JurisdiccionController@getJurisdiccionesSelected')->name('jurisdiccion');
Route::get('/jurisdiccion/edit/{id}', 'JurisdiccionController@edit')->name('edit_jurisdiccion');
Route::put('/jurisdiccion/update/{id}', 'JurisdiccionController@update')->name('update_jurisdiccion');
Route::post('/jurisdiccion/create', 'JurisdiccionController@store')->name('create_jurisdiccion');
Route::delete('/jurisdiccion/delete/{id}', 'JurisdiccionController@destroy')->name('delete_jurisdiccion');

// Organismos
Route::get('/organismo', 'OrganismoController@getOrganismos')->name('organismo');
Route::get('/organismo/{id}', 'OrganismoController@getJurisdiccionesSelected')->name('organismo');
Route::get('/organismo/edit/{id}', 'OrganismoController@edit')->name('edit_organismo');
Route::put('/organismo/update/{id}', 'OrganismoController@update')->name('update_organismo');
Route::post('/organismo/create', 'OrganismoController@store')->name('create_organismo');
Route::delete('/organismo/delete/{id}', 'OrganismoController@destroy')->name('delete_organismo');

// Historias Laborales
Route::get('/hlaborales', 'HistoriaLaboralController@getHistoriaLaborales')->name('historialaboral');
Route::get('/hlaborales_id/{id}', 'HistoriaLaboralController@getHistoriaLaboral')->name('id_historialaboral');
Route::get('/hlaborales_puesto/{id}', 'HistoriaLaboralController@puestoHistoriaLaboralSelected')->name('puesto_historialaboral');
Route::get('/hlaborales/edit/{id}', 'HistoriaLaboralController@edit')->name('edit_historialaboral');
Route::put('/hlaborales/update/{id}', 'HistoriaLaboralController@update')->name('update_historialaboral');
Route::post('/hlaborales/create', 'HistoriaLaboralController@store')->name('create_historialaboral');
Route::delete('/hlaborales/delete/{id}', 'HistoriaLaboralController@destroy')->name('delete_historialaboral');


//Origenes
Route::get('/origen', 'OrigenController@index')->name('origen');
