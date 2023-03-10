<?php

namespace App\Models;

use App\DB\DB;

class Rol
{
    public $id;
    public $nombre;
    public $permisos = [];

    public function __construct($nombre = '')
    {
        $this->nombre = $nombre;
        $this->findByName();
    }

    public static function find($id)
    {
        $data = DB::select(
            "SELECT * FROM roles WHERE roles.id=$id"
        );

        $instance = new self;

        if(count($data)) {
            $usuario = $data[0];
            $instance->id = $id;
            $instance->nombre = $usuario['nombre'];
            $instance->with('permisos');
        }

        return $instance;
    }

    private function permisos()
    {
        $data = DB::select(
            "SELECT * FROM roles_permisos 
            INNER JOIN permisos ON roles_permisos.id_permiso=permiso.id 
            WHERE roles_permisos.id_rol={$this->id}"
        );

        $this->permisos = array_map(fn($permiso) => $permiso->nombre, $data);
    }

    private function findByName()
    {
        $data = DB::select(
            "SELECT * FROM roles WHERE roles.nombre={$this->nombre}"
        );

        if(count($data)) {
            $rol = $data[0];
            $this->id = $rol['id'];
            $this->nombre = $rol['nombre'];
            $this->with('permisos');
        }
    }

    public function hasPermission($name)
    {
        $permiso = array_filter($this->permisos, function ($permiso) use ($name) {
            return $permiso == $name;
        });
    
        return count($permiso) > 0 ? $permiso[0] : false;
    }

    public function with($property)
    {
        $this->$property();
    }
}