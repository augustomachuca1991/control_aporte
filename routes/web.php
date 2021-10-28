<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/dashboard', function () {
    return view('admin.index');
})->name('admin');

//-------- Declaraciones Juradas------------
Route::get('/declaraciones_juradas', 'DeclaracionJuradaController@index')->name('ddjj');


//-------- Declaraciones Juradas Lines------------
Route::get('/declaracion_jurada_lines/{id}', 'DeclaracionJuradaLineController@index')->name('ddjj_detalle');

//-------- Liquidacion Controller------------
Route::get('/liquidacion', 'LiquidacionController@index')->name('liquidaciones');

//-------- Computo Controller------------
Route::get('/computos', 'LiquidacionOrganismoController@index')->name('computos');

//-------- import/export Controller------------
Route::get('/import', 'ExcelController@indexImport')->name('csv_import');
Route::get('/export', 'ExcelController@indexExport')->name('csv_export');


//-------- Categoria Controller------------
Route::get('/categorias', 'CategoriaController@index')->name('categorias');

//-------- Clase Controller------------

Route::get('/clases', 'ClaseController@index')->name('clases');

//-------- Jurisdicciones Controller------------

Route::get('/jurisdicciones', 'JurisdiccionController@index')->name('jurisdicciones');

//-------- Organismos Controller------------
Route::get('/organismos', 'OrganismoController@index')->name('organismos');

//-------- Historia Laborales Controller------------
Route::get('/hlaborales', 'HistoriaLaboralController@index')->name('hlaborales');


//---------- Periodos Controller -------------------------
Route::get('/periodos', 'PeriodoController@index')->name('periodos');

//---------- Conceptos Controller -------------------------
Route::get('/conceptos', 'ConceptoLiquidacionController@index')->name('conceptos');

//---------- Subtipos Controller -------------------------
Route::get('/subtipo-codigos', 'SubtipoCodigoController@index')->name('subtipos');

Route::get('/notificaciones', 'NotificationController@index')->name('notificaciones');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/locker', 'UserController@locker')->name('locker');
