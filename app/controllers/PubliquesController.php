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
           return View::make('pages.publiques'); //Mostra la página publiques
       }
       
       public function PostPubliques(){ //Agafa el post de publiques.
                          $filtrodata = array(
            'millorvalorats' => Input::get('millorvalorats'),
            'radio' => Input::get('radio1'),
            'cercarpubliques' => Input::get('cercarpubliques')
        );
                      $tags = explode(',',Input::get('cercarpubliques'));
                          
                       
                    return View::make('pages.publiques')->with('filtrodata',$filtrodata)->with('tags',$tags);
       }
       public function ShowNotesPubliques($nick)
       {
           
           return View::make('pages.notasusuaripublic')->with('nick',$nick);
       }

}
