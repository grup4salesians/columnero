<?php

class RegistreController extends BaseController {

    public function showFormulari() {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return View::make('pages.registro');
    }

    public function postRegistre() {

        $userdata = array(
            'nom' => Input::get('nom'),
            'cognom' => Input::get('cognoms'),
            'email' => Input::get('correu'),
            'password' => Input::get('password'),
            'contrasenya_confirm' => Input::get('contrasenya_confirm'),
            'nick' => Input::get('nick')
        );
        $rules = [
            'nom' => 'required|min:1',
            'cognom' => 'required|min:1',
            'email' => 'required|email|unique:usuaris',
            'password' => 'required|min:6',
            'contrasenya_confirm' => 'required|same:password',
            'nick' => 'required|min:1'
        ];
        $validator = Validator::make($userdata, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
       
        $usuari = new Usuari();
        $usuari->nom = Input::get('nom');
        $usuari->cognom = Input::get('cognoms');
        $usuari->email = Input::get('correu');
        $usuari->contrasenya = Hash::make(Input::get('password'));
        $usuari->nick = Input::get('nick');
        $usuari->save();

//                Mail::send('emails.template', array('firstname' => Input::get('nom')), function ($message) {
//                    $message->subject('DawSharing04');
//                    $message->to(Input::get('correu'));
//                });

        $userdata = array(
            'email' => Input::get('correu'),
            'password'=> Input::get('password')
        );

        if (Auth::attempt($userdata,1)) {
            return Redirect::to('/');
        }
    }

}

?>