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
        
        public function ShowFiltro(){
             $filtrodata = array(
            'millorvalorats' => Input::get('millorvalorats'),
            'radio' => Input::get('radio1'),
            'buscarhome' => Input::get('buscarhome')
        );
             
         $varia=['Laravel','Eloquent'];

    $query = DB::table('usuaris')
        ->join('posts','usuaris.id','=','posts.usuari_id')
        ->join('postscategories','posts.id','=','postscategories.post_id')
        ->join('categories','postscategories.categoria_id','=','categories.id')
        ->where('usuaris.id','=',Auth::user()->id)
       // ->whereBetween('posts.data',array('2015-05-05 00:00:00','2015-05-05 00:00:00'))    
        ->whereIn('categories.nom',$varia)    
        ->select('postscategories.post_id','posts.titol','posts.comentari','posts.data','postscategories.categoria_id','categories.nom')
        ->get();

var_dump($query);  

             
            return $filtrodata;
        }

}
