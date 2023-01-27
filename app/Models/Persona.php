<?php

namespace App\Models;

use App\DB\DB;

class Persona 
{
    public $id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $fecha_nacimiento;
    public $direccion;
    public $telefono;
    public $sexo;
    public Usuario $usuario;
    

    public function save()
    {
        $id = DB::insert('personas', [
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "cedula" => $this->cedula,
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "sexo" => $this->sexo,
            "id_usuario" => $this->usuario->id
        ]);

        $this->id = $id;
    }

    public function update($data)
    {
        DB::update('personas', $data, $this->id);
    }

    public function delete()
    {
        DB::delete('personas', 'id', '=', $this->id);
    }

    public static function find($id)
    {
        $data = DB::select(
            "SELECT * FROM personas WHERE id=$id"
        );

        if(count($data)) {
            $persona = $data[0];
            $instance = new self;
            $instance->id = $persona['id'];
            $instance->nombre = $persona['nombre'];
            $instance->apellido = $persona['apellido'];
            $instance->cedula = $persona['cedula'];
            $instance->fecha_nacimiento = $persona['fecha_nacimiento'];
            $instance->direccion = $persona['direccion'];
            $instance->telefono = $persona['telefono'];
            $instance->sexo = $persona['sexo'];

            $usuario = Usuario::find($persona['id_usuario']);

            $instance->usuario = $usuario;

            return $instance;
        }
    }
}
