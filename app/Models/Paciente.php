<?php

namespace App\Models;

use App\DB\DB;
use App\Models\Persona;
use App\Models\Usuario;

class Paciente extends Persona
{
    public $dosis = [];

    public static function all()
    {
        $data = DB::select(
            "SELECT personas.*, personas.id as id_persona, usuarios.* 
            FROM personas
            INNER JOIN usuarios 
            ON usuarios.id=personas.id_usuario
            INNER JOIN usuarios_roles
            ON usuarios_roles.id_usuario=usuarios.id
            INNER JOIN roles
            ON roles.id=usuarios_roles.id_rol
            WHERE roles.nombre = 'Paciente'
            
        ");

        $pacientes = [];

        foreach ($data as $value) {
            $paciente = new self;
            
            $paciente->id = $value['id_persona'];
            $paciente->nombre = $value['nombre'];
            $paciente->apellido = $value['apellido'];
            $paciente->cedula = $value['cedula'];
            $paciente->fecha_nacimiento = $value['fecha_nacimiento'];
            $paciente->direccion = $value['direccion'];
            
            $paciente->telefono = $value['telefono'];

            $usuario = new Usuario;
            $usuario->nombre_usuario = $value['nombre_usuario'];
            $usuario->correo = $value['correo'];
            $paciente->usuario = $usuario;

            $pacientes[] = $paciente;
        }

        return $pacientes;
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

    /**
     * Verifica si ya existe una dosis de la vacuna
     * @param Vacuna $vacuna la vacuna a encontrar
     * @return bool
     */
    public function verifyDosis(Vacuna $vacuna)
    {
        $data = Dosis::all();

        $dosis = array_filter($data, function($dosis) use ($vacuna) {
            return $dosis->vacuna->id == $vacuna->id && $dosis->paciente->id == $this->id;
        });

        return count($dosis);
    }
}
