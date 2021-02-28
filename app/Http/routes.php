<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('escuela/categoria','CategoriaController');
Route::resource('escuela/estudiante','EstudianteController');
Route::resource('escuela/funcionario','FuncionarioController');
Route::resource('escuela/ficha','FichaController');

Route::get('/{slug?}', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
