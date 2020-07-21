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
    return view('main.main');
});
Route::resource('conceitos', 'Conceitos');
Route::resource('pesos', 'Pesos');
Route::resource('turmas', 'Turmas');
Route::resource('disciplinas', 'Disciplinas');
Route::resource('cursos', 'Cursos');
Route::resource('componentes', 'Componentes');
