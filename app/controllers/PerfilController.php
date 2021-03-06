<?php

class PerfilController extends BaseController {
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

    public function CambiarPass() {

        $userdata = array(
            'passnueva' => Input::get('passnueva'),
            'passactual' => Input::get('passactual'),
            'contrasenya_confirm' => Input::get('contrasenya_confirm')
        );

        $rules = [
            'passnueva' => 'required|min:5',
            'passactual' => 'required|min:5',
            'contrasenya_confirm' => 'required|same:passnueva'
        ];

        $validator = Validator::make($userdata, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $passnueva = Input::get('passnueva');
        $passnuevahash = Hash::make($passnueva);

        $iduser = Auth::user()->id;

        Usuari::where('id', '=', $iduser)->update(array('contrasenya' => $passnuevahash));

        $mensaje = array(
            'mensaje' => 'La teva contrasenya ha sigut actualitzada.');

        return View::make('pages.perfil', $mensaje);
    }

    public function ShowUser($nick) {



        $userdata = Usuari::where('nick', '=', $nick)->get();

        return View::make('pages.perfilusuari')->with('userdata', $userdata);
    }

}
