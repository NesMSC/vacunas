<?php

namespace App\Http\Controllers;

use App\Http\Request;

use App\Http\Middleware\AuthMiddleware;

use App\Models\Paciente;
use App\Models\Usuario;

class PacientesController 
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
        $this->authMiddleware->handle();
    }

    public function index()
    {
        $pacientes = Paciente::all();

        return view(
            'pacientes.home', 
            ["pacientes" => $pacientes]
        );
    }

    public function create()
    {
        return view('pacientes.create', [], 'principal');
    }

    public function store(Request $request)
    {
        $data = $request->post();
        
        if(!$data) redirect('/');

        try {
            $paciente = new Paciente;
            $paciente->nombre = $data->nombres;
            $paciente->apellido = $data->apellidos;
            $paciente->cedula = $data->nacionalidad.$data->cedula;
            $paciente->fecha_nacimiento = $data->fecha_nacimiento;
            $paciente->direccion = $data->direccion;
            $paciente->telefono = $data->pre_telefono.$data->telefono;
            $paciente->sexo = $data->sexo;

            $usuario = new Usuario;
            $usuario->nombre_usuario = strtolower($data->nombres.$data->apellidos);
            $usuario->correo = $data->email;
            $usuario->roles = [2];
            $usuario->save();

            $paciente->usuario = $usuario;
            $paciente->save();

            redirect("pacientes/ver/{$paciente->id}", ["success" => "Agregado exitosamente!"]);

        } catch (\Throwable $th) {
            http_response_code(500);
            echo $th->getMessage();
            die();
        }

    }

    public function ver($id)
    {
        $paciente = Paciente::find($id);
        return view('pacientes.show', ["paciente" => $paciente], 'principal');
    }
}
