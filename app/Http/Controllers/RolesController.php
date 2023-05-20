<?php

namespace App\Http\Controllers;

use App\Auth;
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
        if(!Auth::hasPermission('roles.consultar')) redirect('');
        $roles = Rol::all();
        return view('roles.home', [
            "roles" => $roles
        ], 'principal');
    }

    public function ver($id)
    {
        if(!Auth::hasPermission('roles.consultar')) redirect('');
        $rol = Rol::find($id);
        return view('roles.show', [
            "rol" => $rol
        ], 'principal');
    }
}