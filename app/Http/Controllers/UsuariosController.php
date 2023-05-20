<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Request;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\Usuario;

class UsuariosController
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
        $this->authMiddleware->handle();
    }
    
    public function index()
    {
        if(!Auth::hasPermission('usuarios.consultar')) redirect('');
        $usuarios = Usuario::all();

        return view('usuarios.home', [
            "usuarios" => $usuarios
        ], 'principal');
    }

    public function ver($id)
    {
        if(!Auth::hasPermission('usuarios.consultar')) redirect('');
        $usuario = Usuario::find($id);
        return view('usuarios.show', ["usuario" => $usuario], 'principal');
    }

    public function editar($id)
    {
        if(!Auth::hasPermission('usuarios.actualizar')) redirect('');
        $usuario = Usuario::find($id);
        return view('usuarios.edit', [
            "usuario" => $usuario,
            "roles" => Rol::all()
        ], 'principal');
    }

    public function buscar(Request $request)
    {
        if(!Auth::hasPermission('usuarios.crear')) redirect('');
        $data = $request->post();
        $cedula = $data?->nacionalidad.$data?->cedula;
        $persona = Persona::findByCI($cedula ?? null);
        if($persona) {
            redirect('usuarios/registrar', [
                "persona" => $persona,
                "roles" => Rol::all()
            ]);
        } else {
            redirect('usuarios/registrar', [
                "error" => "La cédula ingresada no está registrada en el sistema."
            ]);
        }
    }

    public function registrar()
    {
        if(!Auth::hasPermission('usuarios.crear')) redirect('');
        return view('usuarios.create', [], 'principal');
    }

    public function registrarNuevo()
    {
        if(!Auth::hasPermission('usuarios.crear')) redirect('');
        return view('usuarios.create', [
            "nueva" => true, 
            "roles" => Rol::all()
        ], 'principal');
    }

    public function store(Request $request, $id = null)
    {
        if(!Auth::hasPermission('usuarios.crear')) redirect('');
        $data = $request->post();
        if(!$data) redirect('');

        $rol = Rol::find($data->rol);

        try {
            if(is_null($id)) {
                $persona = new Persona;
                $persona->nombre = $data->nombres;
                $persona->apellido = $data->apellidos;
                $persona->cedula = $data->nacionalidad.$data->cedula;
                $persona->fecha_nacimiento = $data->fecha_nacimiento;
                $persona->direccion = $data->direccion;
                $persona->telefono = $data->pre_telefono.$data->telefono;
                $persona->sexo = $data->sexo;

                $usuario = new Usuario;
                $usuario->nombre_usuario = $data->nombre_usuario;
                $usuario->correo = $data->email;
                $usuario->roles = [$rol];
                $usuario->save();

                $persona->usuario = $usuario;
                $persona->save();
            } else {
                $persona = Persona::find($id);
                if(
                    Usuario::hasAvailableRol($persona->usuario) || 
                    !!$persona->usuario->hasRol($rol->nombre)
                ) {
                    redirect('usuarios/registrar', [
                        "message" => "El usuario ya está registrado."
                    ]);
                    die();
                }

                $persona->usuario->update([
                    "nombre_usuario" => $data->nombre_usuario
                ]);
                $persona->usuario->setRol($rol);
            }

            redirect('usuarios/ver/'.$persona->usuario->id, [
                "success" => "Usuario registrado exitosamente."
            ]);

        } catch (\Throwable $th) {
            http_response_code(500);
            echo $th->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::hasPermission('usuarios.actualizar')) redirect('');
        $data = $request->post();

        if(!$data) redirect('');
        $usuario = Usuario::find($id);

        $contrasena = empty($data->password) ? false : encrypt($data->password);

        if($contrasena) {
            $usuario->update([
                "nombre_usuario" => $data->nombre_usuario,
                "contrasena" => $contrasena,
                "correo" => $data->correo
            ]);
        }else {
            $usuario->update([
                "nombre_usuario" => $data->nombre_usuario,
                "correo" => $data->correo
            ]);
        }

        if(!(Auth::getUser()->usuario->id == $id)) {
            $rol = Rol::find($data->rol);
            $usuario->updateRol($rol);
        }

        return view('usuarios.show', [
            "usuario" => Usuario::find($id),
            "success" => "Usuario editado exitosamente."
        ], 'principal');
    }

    public function delete($id)
    {
        if(!Auth::hasPermission('usuarios.eliminar')) redirect('');
        if(Auth::getUser()->usuario->id !== $id) {
            $usuario = Usuario::find($id);
            $usuario->delete();
            redirect('usuarios', ["message" => "El usuario fue eliminado"]);
        } else {
            redirect('usuarios', ["error" => "No puede eliminar su propio usuario."]);
        }
    }
}