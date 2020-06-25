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

	Route::get('/liquidacion', 'LiquidacionController@index')->name('liquidacion');

	//-------- Categoria Controller------------
	Route::get('/categoria', 'CategoriaController@get_categorias')->name('categoria');
	Route::get('/categoria/edit/{id}', 'CategoriaController@edit')->name('edit_categoria');
	Route::put('/categoria/update/{id}', 'CategoriaController@update')->name('update_categoria');
	Route::post('/categoria/create', 'CategoriaController@store')->name('create_categoria');
	Route::delete('/categoria/delete/{id}', 'CategoriaController@destroy')->name('delete_categoria');

	//-------- Clase Controller------------	
	Route::get('/clase', 'ClaseController@index')->name('clase');
	Route::get('/clase/edit/{id}', 'ClaseController@edit')->name('edit_clase');
	Route::put('/clase/update/{id}', 'ClaseController@update')->name('update_clase');
	Route::post('/clase/create', 'ClaseController@store')->name('create_clase');
	Route::delete('/clase/delete/{id}', 'ClaseController@destroy')->name('delete_clase');

	//-------- Jurisdicciones Controller------------

	Route::resource('/jurisdicciones', 'JurisdiccionController')
    ->names('jurisdicciones')
	->parameters(['jurisdicciones' => 'jurisdicciones']);

});


	
