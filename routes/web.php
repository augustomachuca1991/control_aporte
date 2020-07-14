<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/info', function () {
    echo phpinfo();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//middleware admin
Route::middleware('admin')->group(function(){

	Route::get('/dashboard', function(){
		return view('admin.index');
	})->name('admin');

	//-------- Liquidacion Controller------------
	Route::get('/liquidacion', 'LiquidacionController@index')->name('liquidacion');

	//-------- Computo Controller------------
	Route::get('/computo', 'LiquidacionOrganismoController@index')->name('computo');

	//-------- Categoria Controller------------
	Route::get('/categoria', 'CategoriaController@index')->name('categoria');

	//-------- Clase Controller------------

	Route::get('/clase', 'ClaseController@index')->name('clase');

	//-------- Jurisdicciones Controller------------

	Route::resource('/jurisdicciones', 'JurisdiccionController')
    ->names('jurisdicciones')
	->parameters(['jurisdicciones' => 'jurisdicciones']);

    //-------- Organismos Controller------------
    Route::resource('/organismos', 'OrganismoController')
        ->names('organismos')
        ->parameters(['organismos' => 'organismos']);

    //-------- Historia Laborales Controller------------
    Route::resource('/hlaborales', 'HistoriaLaboralController')
        ->names('hlaborales')
        ->parameters(['hlaborales' => 'hlaborales']);

});



