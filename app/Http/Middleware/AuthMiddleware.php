<?php

namespace App\Http\Middleware;

use App\Auth;

class AuthMiddleware {
    public function handle() {
        // Verificar si hay un usuario autenticado
        if (!Auth::check()) {
            // Si no hay usuario autenticado, devolver un mensaje de error
            redirect('login');
        }
    }
}
  