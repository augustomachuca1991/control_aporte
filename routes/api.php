<?php

use App\Http\Controllers\PuestoLaboralController;
use App\TipoLiquidacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
Route::get('/declaracion_jurada', 'DeclaracionJuradaController@getDeclaracionesJuradas');
Route::post('/declaracion_jurada/create', 'DeclaracionJuradaController@store');
Route::put('/declaracion_jurada/update/{id}', 'DeclaracionJuradaController@update');
Route::get('/declaracion_jurada/{id}', 'DeclaracionJuradaController@show');
Route::delete('declaracion_jurada/delete/{id}', 'DeclaracionJuradaController@destroy');
//Declaraciones Juradas detalle
Route::get('/declaracion_jurada/buscar/{search}', 'DeclaracionJuradaController@search');
Route::post('/declaracion_jurada/download', 'DeclaracionJuradaController@download');
Route::get('/declaracion_jurada/aplicar/{user_id}', 'DeclaracionJuradaController@sinAplicar')->name('archivos-recientes');

Route::get('/failedRow/{user_id}', 'DeclaracionJuradaController@getFailedNotificationImport');
Route::post('/readNotifications', 'DeclaracionJuradaController@unReadNotifications');

Route::get('/declaracion_jurada_lines/{cabecara_id}', 'DeclaracionJuradaLineController@getDeclaracionesJuradasLines');


//Route::post('/declaracion_jurada_line/task', 'DeclaracionJuradaLineController@store');

//Computos
Route::get('/computo/origen/{periodo}', 'LiquidacionOrganismoController@computoOrigenes');
Route::get('/computo/jurisdiccion/{periodo}', 'LiquidacionOrganismoController@ComputoJurisdicciones');
Route::get('/computo/organismo/{periodo}', 'LiquidacionOrganismoController@ComputoOrganismos');

Route::get('/computo/origen/tipo-liquidacion/{tipo}', 'LiquidacionOrganismoController@computoTipoLiquidacion_origen');
Route::get('/computo/jurisdiccion/tipo-liquidacion/{tipo}', 'LiquidacionOrganismoController@computoTipoLiquidacion_jurisdiccion');
Route::get('/computo/organismo/tipo-liquidacion/{tipo}', 'LiquidacionOrganismoController@computoTipoLiquidacion_organismo');
Route::get('/computo/periodo-anual/{anio}', 'LiquidacionOrganismoController@periodoAnual');

//liquidaciones
Route::get('/liquidacion', 'LiquidacionController@getliquidaciones')->name('liquidacion');
Route::get('/liquidacion/origen/{id}', 'LiquidacionController@porOrigen');
Route::get('/liquidacion/jurisdiccion/{id}', 'LiquidacionController@porJurisdiccion');
Route::get('/liquidacion/organismo/{id}', 'LiquidacionController@porOrganismo');
Route::post('/liquidacion/agente/{id}', 'LiquidacionController@porAgente');
Route::post('/liquidacion/periodo/{id}', 'LiquidacionController@porPeriodo');
Route::post('/liquidacion/tipo/{id}', 'LiquidacionController@porTipo');
Route::get('/liquidacion/{search}', 'LiquidacionController@search');
Route::get('/liquidacion/paginate/{n_paginas}', 'LiquidacionController@paginado');
Route::get('/liquidacion/hl', 'LiquidacionController@hl');

Route::get('/liquidacion/filter/query', 'LiquidacionController@filter');

Route::post('/liquidaciones', 'LiquidacionController@getFromTo');



// Route::get('/liquidacion/detalle/{id}', 'LiquidacionController@show')->name('liquidacion_detalle');
// Route::get('/liquidacion/agente/filtro','LiquidacionController@agente')->name('filtros');
// Route::get('/liquidacion/filtro','LiquidacionController@filtro')->name('buscar');

//Files Routes
Route::post('/import', 'ExcelController@import')->name('import');
Route::post('/export', 'ExcelController@export')->name('export');




//Puestos Laborales
Route::get('/puesto', 'PuestoLaboralController@getpuestoLaboral')->name('puesto_laboral');

// agente_organismo
// Route::get('/agente_organismo', 'PuestoLaboralController@index')->name('puesto_laboral');
// Route::get('/agente_organismo/{id}', 'PuestoLaboralController@getPuestoLaboralSelected')->name('puesto_laboral');
// Route::get('/agente_organismo/edit/{id}', 'PuestoLaboralController@edit')->name('edit_puesto_laboral');
// Route::put('/agente_organismo/update/{id}', 'PuestoLaboralController@update')->name('update_puesto_laboral');
// Route::post('/agente_organismo/create', 'PuestoLaboralController@store')->name('create_puesto_laboral');
// Route::delete('/agente_organismo/delete/{id}', 'PuestoLaboralController@destroy')->name('delete_puesto_laboral');


//Conceptos
Route::get('/concepto', 'ConceptoLiquidacionController@getConceptos');
Route::put('/concepto/update/{id}', 'ConceptoLiquidacionController@update');
Route::post('/concepto/create', 'ConceptoLiquidacionController@store');
Route::get('/concepto/paginate/{n_paginas}', 'ConceptoLiquidacionController@paginado');
Route::get('/concepto/{search}', 'ConceptoLiquidacionController@search');
Route::get('/concepto/tipo/{id}', 'ConceptoLiquidacionController@perTipo');
Route::get('/concepto/subtipo/{id}', 'ConceptoLiquidacionController@perSubtipo');
Route::get('/concepto/organismo/{id}', 'ConceptoLiquidacionController@perOrganismo');

//Subtipos Codigos
Route::get('/subtipo', 'SubtipoCodigoController@getSubtipo')->name('subtipo');
Route::post('/subtipo/create', 'SubtipoCodigoController@store');
Route::get('/subtipo/{search}', 'SubtipoCodigoController@search');
//Tipos  Codigos
Route::get('/tipocodigo', 'TipoCodigoController@getTipo')->name('tipocodigo');

//Tipos Liquidaciones
Route::get('/tipoliquidacion', 'TipoLiquidacionController@getTipoLiquidacion')->name('tipoliquidacion');

//Periodos
Route::get('/periodo', 'PeriodoController@getPeriodos')->name('periodo');
Route::put('/periodo/update/{id}', 'PeriodoController@update')->name('update_periodo');
Route::post('/periodo/create', 'PeriodoController@store')->name('create_periodo');
Route::delete('/periodo/delete/{id}', 'PeriodoController@destroy')->name('delete_periodo');
Route::get('/periodo/{search}', 'PeriodoController@search')->name('periodo_search');
Route::get('/periodo/order/{column}/sort/{sort}', 'PeriodoController@sort')->name('sort_periodo');
Route::get('/periodo/paginate/{n_paginas}', 'PeriodoController@paginado');

// Categoria
Route::get('/categoria', 'CategoriaController@getCategorias')->name('categorias');
Route::get('/categoria/all', 'CategoriaController@getAllCategorias')->name('categorias_all');
Route::get('/categoria/edit/{id}', 'CategoriaController@edit')->name('edit_categoria');
Route::put('/categoria/update/{id}', 'CategoriaController@update')->name('update_categoria');
Route::post('/categoria/create', 'CategoriaController@store')->name('create_categoria');
Route::delete('/categoria/delete/{id}', 'CategoriaController@destroy')->name('delete_categoria');
Route::get('/categoria/{search}', 'CategoriaController@search')->name('categoria_search');
Route::get('/categoria/order/{column}/sort/{sort}', 'CategoriaController@sort')->name('sort_categoria');
Route::get('/categoria/paginate/{n_paginas}', 'CategoriaController@paginado');


// Clases
Route::get('/clase', 'ClaseController@getClases')->name('clases');
Route::get('/clase/all', 'ClaseController@getAllClases')->name('clases_all');
Route::get('/clase/edit/{id}', 'ClaseController@edit')->name('edit_clase');
Route::put('/clase/update/{id}', 'ClaseController@update')->name('update_clase');
Route::post('/clase/create', 'ClaseController@store')->name('create_clase');
Route::delete('/clase/delete/{id}', 'ClaseController@destroy')->name('delete_clase');
Route::get('/clase/{search}', 'ClaseController@search')->name('clase_search');
Route::get('/clase/order/{column}/sort/{sort}', 'ClaseController@sort')->name('sort_clase');
Route::get('/clase/paginate/{n_paginas}', 'ClaseController@paginado');

// Jurisdicciones
Route::get('/jurisdiccion', 'JurisdiccionController@getJurisdicciones')->name('jurisdiccion');
Route::get('/jurisdiccion/all', 'JurisdiccionController@getAllJurisdicciones')->name('jurisdiccion_all');
Route::get('/jurisdiccion/{search}', 'JurisdiccionController@search')->name('jurisdiccion_search');
Route::get('/jurisdiccion/edit/{id}', 'JurisdiccionController@edit')->name('edit_jurisdiccion');
Route::put('/jurisdiccion/update/{id}', 'JurisdiccionController@update')->name('update_jurisdiccion');
Route::post('/jurisdiccion/create', 'JurisdiccionController@store')->name('create_jurisdiccion');
Route::delete('/jurisdiccion/delete/{id}', 'JurisdiccionController@destroy')->name('delete_jurisdiccion');
Route::get('/jurisdiccion/order/{column}/sort/{sort}', 'JurisdiccionController@sort')->name('sort_jurisdiccion');
Route::get('/jurisdiccion/paginate/{n_paginas}', 'JurisdiccionController@paginado');

// Organismos
Route::get('/organismo', 'OrganismoController@getOrganismos')->name('organismo');
Route::get('/organismo/all', 'OrganismoController@getAllOrganismos')->name('organismo_all');
Route::get('/organismo/{search}', 'OrganismoController@search')->name('organismo_search');
//Route::get('/organismo/edit/{id}', 'OrganismoController@edit')->name('edit_organismo');
Route::put('/organismo/update/{id}', 'OrganismoController@update')->name('update_organismo');
//Route::post('/organismo/create', 'OrganismoController@store')->name('create_organismo');
Route::delete('/organismo/delete/{id}', 'OrganismoController@destroy')->name('delete_organismo');
Route::get('/organismo/order/{column}/sort/{sort}', 'OrganismoController@sort')->name('sort_organismo');
Route::get('/organismo/paginate/{paginas}', 'OrganismoController@paginado');



// Historias Laborales
Route::get('/hlaborales', 'HistoriaLaboralController@getHistoriaLaborales')->name('historialaboral');
Route::get('/hlaborales/puesto/{search}', 'HistoriaLaboralController@search_puesto')->name('historialaboral_search_puesto');
Route::get('/hlaborales/cuil/{search}', 'HistoriaLaboralController@search_cuil')->name('historialaboral_search_cuil');
Route::get('/hlaborales_puesto/{id}', 'HistoriaLaboralController@puestoHistoriaLaboralSelected')->name('puesto_historialaboral');
Route::get('/hlaborales/edit/{id}', 'HistoriaLaboralController@edit')->name('edit_historialaboral');
Route::put('/hlaborales/update/{id}', 'HistoriaLaboralController@update')->name('update_historialaboral');
Route::post('/hlaborales/create', 'HistoriaLaboralController@store')->name('create_historialaboral');
Route::delete('/hlaborales/delete/{id}', 'HistoriaLaboralController@destroy')->name('delete_historialaboral');


//Origenes
Route::get('/origen', 'OrigenController@getOrigenes')->name('origen');
Route::get('/origen/all', 'OrigenController@getAllOrigenes')->name('origen_all');

//Notificaciones
Route::get('/notification', 'NotificationController@getNotificaciones');
Route::get('/notification/{id}', 'NotificationController@notReadNotifications');
Route::post('/notification/leida/{id}', 'NotificationController@markAsReads')->name('leida');


//Agentes

//Route::get('/agente', 'AgenteController@getAgentes')->name('agente');
// Route::post('/agente', 'AgenteController@search')->name('agente_search');
Route::get('/agente/{cuil}', 'AgenteController@porCuil');
Route::get('/agente/puesto/{puesto}', 'AgenteController@porPuesto');




//usuarios
Route::get('/users', 'UserController@getUsers');
Route::put('/users/update/{id}', 'UserController@update');
Route::post('/users/create', 'UserController@store');
Route::get('/users/desbloquear/{id}', 'UserController@desbloquear');
Route::delete('/users/delete/{id}', 'UserController@destroy');
Route::get('/users/{search}', 'UserController@search');
Route::get('/users/paginate/{paginas}', 'UserController@paginado');
Route::get('/users/filter/{role_id}', 'UserController@filter');

//roles
Route::get('/roles', 'RoleController@getRoles');


//departamentos
Route::get('/departamento', 'DptoController@getDptos');



Route::get('/dj', function (Request $request) {

    $string = "1|asdasd|30%|1|1|5000|2|qwerty|18.5%|1|2|25000";
    $explode = explode('|', $string);
    $array_detalle = array_chunk($explode, 6, false);

    $validacion = [
        'detalle' => $array_detalle,
    ];
    $reglas = [
        'detalle' => 'array',
        'detalle.*' => 'array|size:6',
        'detalle.*.0' => 'integer|min:1|required',
        'detalle.*.1' => 'string|required|max:50',
        'detalle.*.2' => 'string|required|max:50',
        'detalle.*.4' => 'integer|exists:subtipo_codigos,id|required',
        'detalle.*.3' => 'integer|exists:tipo_codigos,id|required',
        'detalle.*.5' => 'integer|required',
    ];
    $mensajes = [
        'detalle.array' => 'El campo detalle no cumple con las especificaciones declarada',
    ];
    $validator = Validator::make($validacion, $reglas, $mensajes);

    //dd($validator->fails());
    if (!$validator->fails()) {
        foreach ($array_detalle as $index => $item) {
            $detalle[$index]['cod'] = $item[0];
            $detalle[$index]['concepto'] = $item[1];
            $detalle[$index]['unidad'] = $item[2];
            $detalle[$index]['subtipo'] = $item[3];
            $detalle[$index]['tipo'] = $item[4];
            $detalle[$index]['importe'] = $item[5];
        }
        $json = json_encode($detalle);
        //dd(json_decode($json, true));
        $tipos = TipoLiquidacion::all();
        dd($tipos->pluck('descripcion')->toArray());
    } else {
        dd($validator->errors()->first());
    }


    // $validacion = [
    //     'detalle' => $array_detalle,
    // ];
    // $reglas = [
    //     'detalle.*' => 'array|size:6',
    // ];
    // $mensajes = [
    //     'detalle.*.array' => '* no es array',
    //     'detalle.*.size' => '* no tiene el tamaño especifico',
    // ];
    // $validator = Validator::make($validacion, $reglas, $mensajes);
    // if ($validator->fails()) {
    //     dd($validator->errors()->first());
    // } else {
    //     dd('todo ok');
    // }
});


Route::post('autocomplete', 'AgenteController@autocomplete');
