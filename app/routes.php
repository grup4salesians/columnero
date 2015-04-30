<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('pages.home');
});

Route::get('login', 'AuthController@showLogin'); // Nos mostrará el formulario de login.
Route::post('login', 'AuthController@postLogin'); // Validamos los datos de inicio de sesión.
//PAGINA DE REGISTRO---
Route::get('registro', 'HomeController@ShowRegistro'); // Nos mostrará el formulario de registro.
Route::post('registro', 'HomeController@PostRegistro'); // Nos registrará en la pagina a través de la función PostRegistro de HomeController.
//--------------------
