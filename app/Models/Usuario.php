<?php

namespace App\Models;

use App\DB\DB;

use App\Models\Persona;

class Usuario
{
    public $id;
    public $nombre_usuario;
    public $correo;
    public array $roles = [];

    static function checkCredentials($data)
    {
        $contrasena = encrypt($data->password);
        $query = DB::select(
            "SELECT * FROM usuarios
                INNER JOIN personas
                ON usuarios.id = personas.id_usuario
                WHERE contrasena='$contrasena'
                AND correo='{$data->email}'");

        if(count($query)){
            $user = $query[0];
            $instance = new Persona;
            $instance->nombre = $user['nombre'];
            $instance->apellido = $user['apellido'];
            $instance->cedula = $user['cedula'];
            $instance->fecha_nacimiento = $user['fecha_nacimiento'];
            $instance->telefono = $user['telefono'];
            
            $usuario = new self;
            $usuario->correo = $user['correo'];
            $usuario->nombre_usuario = $user['nombre_usuario'];
            $usuario->roles();
            $instance->usuario = $usuario;

            return $instance;
        }

        return false;
    }

    public static function find($id)
    {
        $data = DB::select("SELECT * FROM usuarios WHERE id=$id");

        $instance = new self;

        if(count($data)) {
            $usuario = $data[0];
            $instance->id = $id;
            $instance->nombre_usuario = $usuario['nombre_usuario'];
            $instance->correo = $usuario['correo'];
        }

        return $instance;
    }

    public function save()
    {
        $contrasena = encrypt($this->nombre_usuario);
        $id = DB::insert('usuarios', [
            "nombre_usuario" => $this->nombre_usuario,
            "contrasena" => $contrasena,
            "correo" => $this->correo
        ]);

        foreach($this->roles as $rol) {
            DB::insert('usuarios_roles', [
                "id_usuario" => $id,
                "id_rol" => $rol->id
            ]);
        }

        $this->id = $id;
    }

    public function update($data)
    {
        DB::update('usuarios', $data, $this->id);
    }

    public function roles()
    {
        $data = DB::select(
            "SELECT roles.nombre FROM usuarios_roles
            INNER JOIN roles ON roles.id=usuarios_roles.id_rol
            WHERE usuarios_roles.id_usuario={$this->id}"
        );

        $this->roles = array_map(function ($rol) {
            return new Rol($rol["nombre"]);
        }, $data);
    }

    public function hasRol($name)
    {
        $rol = array_filter($this->roles, function ($rol) use ($name) {
            return $rol->nombre == $name;
        });
    
        // Verificar si se encontró un rol con el nombre especificado
        if (count($rol) > 0) {
            // Devolver el primer rol encontrado
            return $rol[0];
        } else {
            // El usuario no tiene este rol
            return false;
        }
    }
}
