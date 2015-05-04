<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
            
		return View::make('home');
	}
        public function ShowNovaNota(){
            return View::make('pages.novanota');
        }
        public function ShowMevesNotes(){
            return View::make('pages.mevesnotes');
        }
        public function ShowPreferits(){
            return View::make('pages.preferits');
        }
        public function ShowPerfil(){
            return View::make('pages.perfil');
        }  

}
