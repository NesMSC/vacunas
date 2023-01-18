<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Models\Usuario;

class LoginController {
    
    public function index()
    {
        return view('auth.login', [], 'principal');
    }

    public function signin($request)
    {
        $data = $request->post();


        if(!$data) redirect('/');

        $user = Usuario::checkCredentials($data);

        if($user) {
            Auth::start($user);
            redirect('home');
        }else {
            redirect('login', ["error" => "Credenciales incorrectas"]);
        }
    }

    public function logout()
    {
        Auth::destroy();
    }
}
