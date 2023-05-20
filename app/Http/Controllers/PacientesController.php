<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Http\Request;

use App\Http\Middleware\AuthMiddleware;

use App\Models\Paciente;
use App\Models\Rol;
use App\Models\Vacuna;
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
        if(!Auth::hasPermission('pacientes.consultar')) redirect('');
        $pacientes = Paciente::all();

        return view(
            'pacientes.home', 
            ["pacientes" => $pacientes],
            'principal'
        );
    }

    public function create()
    {
        if(!Auth::hasPermission('pacientes.crear')) redirect('');
        return view('pacientes.create', [], 'principal');
    }

    public function ver($id)
    {
        if(!Auth::hasPermission('pacientes.consultar')) redirect('');
        $paciente = Paciente::find($id);
        return view('pacientes.show', ["paciente" => $paciente], 'principal');
    }

    public function editar($id)
    {
        if(!Auth::hasPermission('pacientes.actualizar')) redirect('');
        $paciente = Paciente::find($id);
        return view('pacientes.edit', ["paciente" => $paciente], 'principal');
    }

    public function store(Request $request)
    {
        if(!Auth::hasPermission('pacientes.crear')) redirect('');
        $data = $request->post();
        
        if(!$data) redirect('');

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
            $usuario->roles = [ new Rol('Paciente') ];
            $usuario->save();

            $paciente->usuario = $usuario;
            $paciente->save();

            redirect("dosis/asignar/{$paciente->id}", ["success" => "Agregado exitosamente! Asigna una vacuna"]);

        } catch (\Throwable $th) {
            http_response_code(500);
            echo $th->getMessage();
        }

    }

    public function update(Request $request, $id)
    {
        if(!Auth::hasPermission('pacientes.actualizar')) redirect('');
        $data = $request->post();

        if(!$data) redirect('');

        $paciente = Paciente::find($id);

        try {
            $paciente->update([
                "nombre" => $data->nombres,
                "apellido" => $data->apellidos,
                "cedula" => $data->nacionalidad.$data->cedula,
                "fecha_nacimiento" => $data->fecha_nacimiento,
                "direccion" => $data->direccion,
                "telefono" => $data->pre_telefono.$data->telefono,
                "sexo" => $data->sexo
            ]);

            $paciente->usuario->update([
                "correo" => $data->email
            ]);

            redirect("pacientes/ver/{$paciente->id}", ["success" => "Los datos fueron editados exitosamente"]);

        } catch (\Throwable $th) {
            throw $th->__toString();
        }
    }

    public function delete($id)
    {
        if(!Auth::hasPermission('pacientes.eliminar')) redirect('');
        $paciente = Paciente::find($id);
        $paciente->delete();
        redirect('pacientes', ["message" => "El paciente fue eliminado"]);
    }
}
