<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthMiddleware;

use App\Models\Rol;

class RolesController
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
        $this->authMiddleware->handle();
    }

    public function index()
    {
        $roles = Rol::all();
        return view('roles.home', [
            "roles" => $roles
        ], 'principal');
    }

    public function ver($id)
    {
        $rol = Rol::find($id);
        return view('roles.show', [
            "rol" => $rol
        ], 'principal');
    }
}