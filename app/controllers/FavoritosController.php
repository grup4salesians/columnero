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

            $Favoritonuevo = new Valoracions();
            $Favoritonuevo->usuari_id = Auth::user()->id;
            $Favoritonuevo->post_id = $id;
            $Favoritonuevo->favorit = 1;
            $Favoritonuevo->save();
        }
        return Redirect::to('publiques'); //Mostra la página publiques
    }

}
