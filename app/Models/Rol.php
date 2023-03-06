<?php

namespace App\Models;

use App\DB\DB;

class Rol
{
    public $id;
    public $nombre;
    public $descripcion;
    public $permisos = [];
    public bool $status;

    public function __construct($nombre = '')
    {
        $this->nombre = $nombre;
        $this->findByName();
    }

    static function all()
    {

        $data = DB::select(
            "SELECT * FROM roles WHERE status=1");

        $array_roles = [];

        foreach ($data as $value) {
            $rol  = new self;
            $rol->id = $value['id'];
            $rol->nombre = $value['nombre'];
            $rol->descripcion = $value['descripcion'];
            $rol->status = $value['status'];
            $rol->permisos();
            $array_roles[] = $rol;
        }

        return  array_filter(
            $array_roles, 
            fn($rol) => $rol->status
        );
    }

    public static function find($id)
    {
        $data = DB::select(
            "SELECT * FROM roles WHERE roles.id=$id"
        );

        $instance = new self;

        if(count($data)) {
            $rol = $data[0];
            $instance->id = $id;
            $instance->nombre = $rol['nombre'];
            $instance->descripcion = $rol['descripcion'];
            $instance->status = $rol['status'];
            $instance->with('permisos');
        }

        return $instance;
    }

    private function permisos()
    {
        $data = DB::select(
            "SELECT * FROM roles_permisos 
            INNER JOIN permisos ON roles_permisos.id_permiso=permisos.id 
            WHERE roles_permisos.id_rol={$this->id}"
        );

        $this->permisos = array_map(fn($permiso) => (object)[
            "nombre" => $permiso["nombre"],
            "descripcion" => $permiso["descripcion"]
        ], $data);
    }

    private function findByName()
    {
        $data = DB::select(
            "SELECT * FROM roles WHERE roles.nombre='{$this->nombre}'"
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
        $permiso = array_values(array_filter($this->permisos, function ($permiso) use ($name) {
            return $permiso->nombre == $name;
        }));

        return count($permiso) > 0 ? $permiso[0] : false;
    }

    public function with($property)
    {
        $this->$property();
    }
}