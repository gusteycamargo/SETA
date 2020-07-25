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
Route::get('cursos/load', 'Cursos@loadJson');
Route::get('turmas/load', 'Turmas@loadJson');
Route::get('componentes/load', 'Componentes@loadJson');
Route::resource('conceitos', 'Conceitos');
Route::resource('pesos', 'Pesos');
Route::resource('cursos', 'Cursos');
Route::resource('turmas', 'Turmas');
Route::resource('disciplinas', 'Disciplinas');
Route::resource('componentes', 'Componentes');

