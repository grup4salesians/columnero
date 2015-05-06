<?php

class PubliquesController extends BaseController {

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

        
       public function ShowPubliques(){
           
                 $filtrodata = array(
            'millorvalorats' => Input::get('millorvalorats'),
            'radio' => Input::get('radio1'),
            'cercarpubliques' => Input::get('cercarpubliques')
        );
           
                 
           return View::make('pages.publiques')->with(array('filtrodata'=>$filtrodata));
       }

}
