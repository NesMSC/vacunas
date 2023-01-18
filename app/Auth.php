<?php

namespace App;

if(!isset($_SESSION)) {
    session_start();
}

class Auth
{

    static function check()
    {
        return isset($_SESSION['X-TOKEN']);
    }

    static function destroy()
    {
        session_destroy();
    
        header('Location: /login');
    }

    static function start($user)
    {
        $_SESSION['X-TOKEN'] = encrypt($user->correo.time());

        $_SESSION['CURRENT-USER'] = $user;
    }

    static function getUser()
    {
        return $_SESSION['CURRENT-USER'];
    }
}