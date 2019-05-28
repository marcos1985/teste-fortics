<?php

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

Route::get("/marcas", [ "uses" => "MarcasController@index"]);
Route::get("/marcas/novo", [ "uses" => "MarcasController@create"]);
Route::post("/marcas/adicionar", [ "uses" => "MarcasController@strore"]);
Route::get("/marcas/{id}/editar", [ "uses" => "MarcasController@edit"]);
Route::post("/marcas/atualizar", [ "uses" => "MarcasController@update"]);
Route::post("/marcas/ajax/excluir", [ "uses" => "MarcasController@ajaxDelete"]);
