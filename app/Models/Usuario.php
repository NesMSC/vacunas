<?php

namespace App\Models;

use App\DB\DB;

use App\Models\Persona;

class Usuario
{
    public $id;
    public $nombre_usuario;
    public $correo;
    public $roles = [];
    public $permisos = [];

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

        DB::insert('usuarios_roles', [
            "id_usuario" => $id,
            "id_rol" => $this->roles[0]
        ]);

        $this->id = $id;
    }

    public function update($data)
    {
        DB::update('usuarios', $data, $this->id);
    }
}
