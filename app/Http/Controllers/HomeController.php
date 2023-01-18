<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthMiddleware;

class HomeController
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
    }

    /**
     * Vista principal
     */
    public function index()
    {
        $this->authMiddleware->handle();
        
        return view('panel.panel', ["saludo" => "Bienvenido"], 'principal');
    }

    public function panel()
    {
        return view('panel.panel');
    }
}