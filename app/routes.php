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



Route::group(array('before' => 'auth'), function() {
    Route::get('/', function() {
        return View::make('pages.home');
    });

    //MENU DE USUARI----

    Route::get('preferits', 'HomeController@ShowPreferits');
    Route::get('mevesnotes', 'HomeController@ShowMevesNotes');
    Route::get('perfil', 'HomeController@ShowPerfil');

    //PERFIL--
    Route::post('cambiarpass', 'PerfilController@CambiarPass');
    Route::get('usuari/{nickname}', array('nickname' => 'nickname', 'uses' => 'PerfilController@ShowUser'));

    //NOTES PUBLIQUES
    Route::get('publiques', 'PubliquesController@ShowPubliques');
    Route::post('publiques', 'PubliquesController@PostPubliques');

    //FILTRO HOME----
    Route::post('cercarhome', 'HomeController@ShowFiltro');
    Route::get('logout', 'AuthController@logOut'); // Esta ruta nos servirá para cerrar sesión.

    //NOVA NOTA
    Route::get('novanota', 'NovanotaController@ShowNovaNota');
    Route::post('novanota', 'NovanotaController@PostNovaNota');
    
    Route::get('getCategories/{query}', 'NovanotaController@selectcategories');
    
    //MEVES NOTES
    Route::get('eliminarnota/{id}',array('id' => 'id', 'uses' =>'NotapersonalController@EliminarNota'));
    Route::get('editarnota/{id}',array('id' => 'id', 'uses' =>'NotapersonalController@EditarNota'));
    Route::post('editarnota/{id}',array('id' => 'id', 'uses' =>'NotapersonalController@PostEditarNota'));
    
    //NOTES USUARIS
    
    Route::get('vernotas/{nick}',array('nick' => 'nick', 'uses' =>'PubliquesController@ShowNotesPubliques'));
});
//Route::get("/1", function() {
////    --------------------- SELECCT ALL ----------------------
//    Route::resource('{query}', 'NovanotaController@selectcategories');
//    
//});




