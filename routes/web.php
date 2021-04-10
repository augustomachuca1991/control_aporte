<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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




	Route::get('/pipe/{detalle}', function($detalle){


		$name_array = explode( '|', $detalle);
		$detalles = array_chunk($name_array, 5, false);
		for ($i=0; $i < count($detalles) ; $i++) {
			for ($j=0; $j < count($detalles[$i]) ; $j++) { 
			 	$resultado[$i]['cod'] = $detalles[$i][0];
			 	$resultado[$i]['concepto'] = $detalles[$i][1];
			 	$resultado[$i]['unidad'] = $detalles[$i][2];
			 	$resultado[$i]['tipo'] = $detalles[$i][3];
			 	$resultado[$i]['monto'] = $detalles[$i][4];
			 }
			
		}
		return $resultado;
	});

	Route::get('/dashboard', function(){
		return view('admin.index');
	})->name('admin');

	//-------- Declaraciones Juradas------------
	Route::get('/declaraciones_juradas', 'DeclaracionJuradaController@index')->name('ddjj');
	Route::get('/declaraciones_juradas/{id}', 'DeclaracionJuradaController@show')->name('ddjj_detalle');
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

    Route::get('/notificaciones', 'NotificationController@index')->name('notificaciones');

    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/locker', 'UserController@locker')->name('locker');





