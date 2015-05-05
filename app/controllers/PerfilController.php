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

        
        public function CambiarPass(){
          
               $userdata = array(
            'passnueva' => Input::get('passnueva'),
            'passactual' => Input::get('passactual'),
            'contrasenya_confirm' => Input::get('contrasenya_confirm')
        );
             $passactual = Auth::user()->contrasenya;
            
             $rules = [
            'passnueva' => 'required|min:1',
            'contrasenya_confirm' => 'required|same:passnueva'
        ];
             
        $validator = Validator::make($userdata, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $passnueva = Input::get('passnueva');
        $passnuevahash = Hash::make($passnueva);
        $iduser = Auth::user()->id;
        
       Usuari::where('usuari_id',$iduser)->update(array('contrasenya' => '123'));
       
           return View::make('pages.perfil')->with('mensaje_error', 'La teva contrasenya ha sigut actualitzada.');
        }

}
