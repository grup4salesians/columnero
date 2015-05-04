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
        public function showRegistro()
	{
            
		return View::make('pages.registro');
	}
        public function PostRegistro(){
            
            $userdata = array(
            'nom' => Input::get('nom'),
            'cognoms' => Input::get('cognoms'),
            'correu' => Input::get('correu'),
            'password' => Input::get('password'),
            'contrasenya_confirm' => Input::get('contrasenya_confirm'),
            'nick' => Input::get('nick')
        );
        $rules = [
            'nom' => 'required|min:1',
            'cognoms' => 'required|min:1',
            'correu' => 'required|email|unique:usuaris',
            'contrasenya' => 'required|min:6',
            'contrasenya_confirm' => 'required|same:password',
            'nick' => 'required|min:1'
            
        ];
            $validator = Validator::make($userdata, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

//            $usuari = new Usuari();
//            $usuari->nom = Input::get('nom');
//            $usuari->cognoms = Input::get('cognoms');
//            $usuari->correu = Input::get('correu');
//            $usuari->contrasenya = Hash::make(Input::get('password'));
//            $usuari->fecha_inscripcion = date("d-m-Y H:i:s");
//            $usuari->telefon = Input::get('telefon');
//            $usuari->save();
//            
//            Mail::send('emails.template', array('firstname'=>Input::get('nom')), function ($message) {
//                $message->subject('DawSharing04');
//                $message->to(Input::get('correu'));
//            });
                return Redirect::to('/');
  
            $userdata = array(
                'correu' => Input::get('correu'),
                'password' => Input::get('password')
            );

            if (Auth::attempt($userdata, Input::get('remember-me', 0))) {
                return Redirect::to('/');
            }

    
        }

}
