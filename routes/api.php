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
Route::get('/jurisdiccion', 'JurisdiccionController@index')->name('jurisdiccion');
Route::get('/organismo', 'OrganismoController@index')->name('organismo');
Route::get('/categoria', 'CategoriaController@categoria_json')->name('categoria');
