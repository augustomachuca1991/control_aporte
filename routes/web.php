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

Route::middleware('admin')->group(function(){
	Route::get('/dashboard', function(){
		return view('admin.index');
	})->name('admin');

	Route::get('/liquidacion', function(){

		return view('admin.liquidacion');
	})->name('liquidacion');

	// Categoria 

	Route::get('/categorias', 'CategoriaController@index')->name('categorias');
	Route::post('/categorias/create','CategoriaController@store')->name('create_categoria');
	Route::get('/categorias/delete/{id}','CategoriaController@delete')->name('delete_categoria');

	//-------- Jurisdicciones Controller------------

Route::resource('/jurisdicciones', 'JurisdiccionController')
    ->names('jurisdicciones')
	->parameters(['jurisdicciones' => 'jurisdicciones']);

});


	
