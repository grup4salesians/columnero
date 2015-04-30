<?php

class AuthController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Controlador de la autenticación de usuarios
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('pages.login');
    }

    /**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'email' => Input::get('email'),
            'password'=> Input::get('contrasenya')
        );
        
        if(Auth::attempt($userdata, Input::get('rememberme', 0))) { // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/');
            
        }
      // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('login')
                    ->with('mensaje_error', 'Les teves dades són incorrectes')
                    ->withInput();
    }

    /**
     * Muestra el formulario de login mostrando un mensaje de que cerró sesión.
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('login')->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }
}