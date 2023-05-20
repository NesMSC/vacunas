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
    public Persona $persona;

    static function all()
    {
        $data = DB::select(
            "SELECT * FROM usuarios");

        $array_usuarios = [];

        foreach ($data as $value) {
            $usuario = new self;
            $usuario->id = $value['id'];
            $usuario->nombre_usuario = $value['nombre_usuario'];
            $usuario->correo = $value['correo'];
            $usuario->roles();
            $array_usuarios[] = $usuario;
        }

        return  array_filter(
            $array_usuarios, 
            function ($usuario) {
                return Usuario::hasAvailableRol($usuario);
            }
        );
    }

    static function checkCredentials($data)
    {
        $contrasena = encrypt($data->password);
        $query = DB::select(
            "SELECT personas.*, usuarios.id as id_usuario, usuarios.* 
                FROM usuarios
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
            $usuario->id = $user['id_usuario'];
            $usuario->correo = $user['correo'];
            $usuario->nombre_usuario = $user['nombre_usuario'];
            $instance->usuario = $usuario;
            $instance->usuario->roles();

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
            $instance->persona();
            $instance->roles();
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

    public function setRol(Rol $rol)
    {
        if(!$this->hasRol($rol->nombre)) {
            DB::insert('usuarios_roles', [
                "id_usuario" => $this->id,
                "id_rol" => $rol->id
            ]);
        }
    }

    public function updateRol(Rol $rol)
    {
        $query = "UPDATE usuarios_roles
        SET `id_rol`={$rol->id}
        WHERE `id_usuario`={$this->id}";

        // Puede que el usuario tenga un rol inactivo. 
        // Los roles inactivos no apareceran en el array de roles.
        if(count($this->roles) > 0) {
            $query .= " AND `id_rol`={$this->roles[0]->id}";
        }

        if(!$this->hasRol($rol->nombre)) {
            DB::query($query);
        }
    }

    public function persona()
    {
        $data = DB::select("SELECT * FROM personas WHERE id_usuario={$this->id}")[0];

        $this->persona = recast(Persona::class, (object)[
            "id" => $data['id'],
            "nombre" => $data['nombre'],
            "apellido" => $data['apellido'],
            "cedula" => $data['cedula'],
            "fecha_nacimiento" => $data['fecha_nacimiento'],
            "direccion" => $data['direccion'],
            "telefono" => $data['telefono'],
            "sexo" => $data['sexo']
        ]);
    }

    public function roles()
    {
        $data = DB::select(
            "SELECT roles.nombre FROM usuarios_roles
            INNER JOIN roles ON roles.id=usuarios_roles.id_rol
            WHERE usuarios_roles.id_usuario={$this->id} 
            AND roles.status = 1"
        );

        if(!empty($data)) {
            $this->roles = array_map(function ($rol) {
                return new Rol($rol["nombre"]);
            }, array_values($data));
        }
    }

    private function allRoles()
    {
        $data = DB::select(
            "SELECT roles.nombre FROM usuarios_roles
            INNER JOIN roles ON roles.id=usuarios_roles.id_rol
            WHERE usuarios_roles.id_usuario={$this->id}"
        );

        if(!empty($data)) {
            return array_map(function ($rol) {
                return new Rol($rol["nombre"]);
            }, array_values($data));
        }
    }

    public static function hasAvailableRol($usuario) 
    {
        $roles = [];
        $availableRoles = array_map(function ($rol) {
            return $rol->nombre;
        }, Rol::all());

        foreach($usuario->roles as $rol) {
            $roles[] = $rol->nombre;
        }

        foreach ($roles as $role) {
            if (in_array($role, $availableRoles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRol($name): Rol | bool
    {
        $rol = array_filter($this->allRoles(), function ($rol) use ($name) {
            return $rol->nombre == $name;
        });
        // Verificar si se encontró un rol con el nombre especificado
        if (count($rol) > 0) {
            // Devolver el primer rol encontrado
            return array_values($rol)[0];
        } else {
            // El usuario no tiene este rol
            return false;
        }
    }

    public function delete()
    {
        if(!$this->hasRol('Paciente')) {
            $this->persona->delete();
            DB::delete('usuarios', 'id', '=', $this->id);
        }else {
            foreach ($this->roles as $rol) {
                if($rol->nombre != 'Paciente') {
                    DB::delete('usuarios_roles', 'id_usuario', '=', "{$this->id} AND id_rol={$rol->id}");
                }
            }
        }
    }
}
