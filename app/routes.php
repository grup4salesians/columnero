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

//Route::get('/prueba', function()
//{
//	return View::make('pages.prueba');
//});


//LOGIN & LOGOUT ----------
Route::get('login', 'AuthController@showLogin'); // Nos mostrará el formulario de login.
Route::post('login', 'AuthController@postLogin'); // Validamos los datos de inicio de sesión.

//--------------------
//PAGINA DE REGISTRO---
Route::get('registro', 'RegistreController@showFormulari'); // Nos mostrará el formulario de registro.
Route::post('registro', 'RegistreController@postRegistre'); // Nos registrará en la pagina a través de la función PostRegistro de HomeController.
//--------------------

//MENU DE USUARI----
Route::get('novanota', 'HomeController@ShowNovaNota'); 
Route::get('preferits', 'HomeController@ShowPreferits'); 
Route::get('mevesnotes', 'HomeController@ShowMevesNotes'); 
Route::get('perfil', 'HomeController@ShowPerfil'); 

//PERFIL--
Route::post('cambiarpass','PerfilController@CambiarPass');
Route::get('usuari/{nickname}',array('nickname' => 'nickname', 'uses' =>'PerfilController@ShowUser'));

//FILTRO HOME----

Route::post('cercarhome', 'HomeController@ShowFiltro');

Route::group(array('before' => 'auth'), function() {
	Route::get('/', function()
	{
		return View::make('pages.home');
	});
    Route::get('logout', 'AuthController@logOut'); // Esta ruta nos servirá para cerrar sesión.
});
