<?php

use App\Liquidacion;
use App\PuestoLaboral;
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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //-------- Declaraciones Juradas------------
    Route::get('/declaraciones_juradas', 'DeclaracionJuradaController@index')->middleware('admin')->name('ddjj');


    //-------- Declaraciones Juradas Lines------------
    Route::get('/declaracion_jurada_lines/{id}', 'DeclaracionJuradaLineController@index')->middleware('admin')->name('ddjj_detalle');

    //-------- Liquidacion Controller------------
    Route::get('/liquidacion', 'LiquidacionController@index')->name('liquidaciones');
    Route::get('/liquidacion2', 'LiquidacionController@index2')->name('liquidaciones2');

    //-------- Computo Controller------------
    Route::get('/computos', 'LiquidacionOrganismoController@index')->name('computos');

    //-------- import/export Controller------------
    Route::get('/import', 'ExcelController@indexImport')->name('csv_import');
    Route::get('/export', 'ExcelController@indexExport')->name('csv_export');


    //-------- Categoria Controller------------
    Route::get('/categorias', 'CategoriaController@index')->middleware('admin')->name('categorias');

    //-------- Clase Controller------------

    Route::get('/clases', 'ClaseController@index')->middleware('admin')->name('clases');

    //-------- Jurisdicciones Controller------------

    Route::get('/jurisdicciones', 'JurisdiccionController@index')->middleware('admin')->name('jurisdicciones');

    //-------- Organismos Controller------------
    Route::get('/organismos', 'OrganismoController@index')->middleware('admin')->name('organismos');

    //-------- Historia Laborales Controller------------
    Route::get('/hlaborales', 'HistoriaLaboralController@index')->name('hlaborales');


    //---------- Periodos Controller -------------------------
    Route::get('/periodos', 'PeriodoController@index')->name('periodos');

    //---------- Conceptos Controller -------------------------
    Route::get('/conceptos', 'ConceptoLiquidacionController@index')->middleware('admin')->name('conceptos');

    //---------- Subtipos Controller -------------------------
    Route::get('/subtipo-codigos', 'SubtipoCodigoController@index')->middleware('admin')->name('subtipos');

    Route::get('/notificaciones', 'NotificationController@index')->name('notificaciones');

    //---------- User Controller -------------------------
    Route::get('/users', 'UserController@index')->middleware('admin')->name('users');
    Route::get('/users/locker', 'UserController@locker')->name('locker');
    Route::get('/profile', 'UserController@profile')->name('user.profile');


    //---------- Configuracion Controller -------------------------
    Route::get('/configuracion', 'ConfiguracionController@index')->middleware('admin')->name('config');
});


Route::get('/test', function () {
    $desde = 202001;
    $hasta = 202007;
    $pl = Liquidacion::where('id', 1)
        ->whereHas('periodos', function ($periodos) use ($desde, $hasta) {
            $periodos->whereBetween('cod_periodo', [$desde, $hasta]);
        })->with(['liquidacionOrganismo', 'historia_laborales'])->get();
    return $pl;


    // $agente_id = 3;
    // return PuestoLaboral::whereHas('agente', function ($agente) use ($agente_id) {
    //     $agente->where('id', $agente_id);
    // })->with('agente')->get();

    // $pl = PuestoLaboral::where('id', 1);
    // return $pl->with('agente')->get();
});
