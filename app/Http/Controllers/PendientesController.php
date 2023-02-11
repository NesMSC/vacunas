<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Middleware\AuthMiddleware;

use App\Models\Paciente;
use App\Models\Pendiente;
use App\Models\Vacuna;

class PendientesController
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
        $this->authMiddleware->handle();
    }

    public function asignar($id)
    {
        return view('pendientes.asignar', [
            "paciente" => Paciente::find($id),
            "vacunas" => Vacuna::all()
        ], 'principal');
    }

    public function crear(Request $request)
    {
        $data = $request->post();

        if(!$data) redirect('/');

        try {
            $vacuna = Vacuna::find($data->vacuna);
            $paciente = Paciente::find($data->paciente);
    
            $pendiente = new Pendiente;
            $pendiente->paciente = $paciente;
            $pendiente->vacuna = $vacuna;
            $pendiente->fecha_prevista = $data->fecha_prevista;
            $pendiente->save();

            redirect("pacientes/ver/{$paciente->id}",  ["success" => "Vacuna asignada exitosamente"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}