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


Route::get("/tipos-refrigerantes", [ "uses" => "TiposRefrigeranteController@index"]);
Route::get("/tipos-refrigerantes/novo", [ "uses" => "TiposRefrigeranteController@create"]);
Route::post("/tipos-refrigerantes/adicionar", [ "uses" => "TiposRefrigeranteController@strore"]);
Route::get("/tipos-refrigerantes/{id}/editar", [ "uses" => "TiposRefrigeranteController@edit"]);
Route::post("/tipos-refrigerantes/atualizar", [ "uses" => "TiposRefrigeranteController@update"]);
Route::post("/tipos-refrigerantes/ajax/excluir", [ "uses" => "TiposRefrigeranteController@ajaxDelete"]);

Route::get("/litragens", [ "uses" => "LitragensController@index"]);
Route::get("/litragens/novo", [ "uses" => "LitragensController@create"]);
Route::post("/litragens/adicionar", [ "uses" => "LitragensController@strore"]);
Route::get("/litragens/{id}/editar", [ "uses" => "LitragensController@edit"]);
Route::post("/litragens/atualizar", [ "uses" => "LitragensController@update"]);
Route::post("/litragens/ajax/excluir", [ "uses" => "LitragensController@ajaxDelete"]);


Route::get("/refrigerantes", [ "uses" => "RefrigerantesController@index"]);
Route::get("/refrigerantes/novo", [ "uses" => "RefrigerantesController@create"]);
Route::post("/refrigerantes/adicionar", [ "uses" => "RefrigerantesController@strore"]);
Route::get("/refrigerantes/{id}/editar", [ "uses" => "RefrigerantesController@edit"]);
Route::post("/refrigerantes/atualizar", [ "uses" => "RefrigerantesController@update"]);
Route::post("/refrigerantes/ajax/excluir", [ "uses" => "RefrigerantesController@ajaxDelete"]);
