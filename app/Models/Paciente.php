<?php

namespace App\Models;

use App\DB\DB;
use App\Models\Persona;
use App\Models\Usuario;

class Paciente extends Persona
{
    
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
}
