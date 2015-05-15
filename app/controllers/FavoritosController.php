<?php

class FavoritosController extends BaseController {
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

    public function SetFavorito($id) {

        $queryfavoritos = DB::table('valoracions')
                ->where('usuari_id', '=', Auth::user()->id)
                ->where('post_id', '=', $id)
                ->where('favorit', '=', 1)
                ->get();


        if (count($queryfavoritos) == 0) {

            $Favoritonuevo = new valoracions();
            $Favoritonuevo->usuari_id = Auth::user()->id;
            $Favoritonuevo->post_id = $id;
            $Favoritonuevo->favorit = 1;
            $Favoritonuevo->save();
        }
        return Redirect::to('preferits'); //Mostra la página publiques
    }
    
    public function DeleteFavorito($id)
    {
        valoracions::where('post_id','=',$id)->where('usuari_id','=',Auth::user()->id)->delete();
        return Redirect::to('publiques');
    }
    
    public function ShowFavorito(){
        
        $tags = explode(',',Input::get('cercarpubliques'));
                          
                       
                    return View::make('pages.preferits')->with('tags',$tags);
    }

}
