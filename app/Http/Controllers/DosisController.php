<?php

namespace App\Http\Controllers;

use App\Http\Request;

use App\Http\Middleware\AuthMiddleware;

use App\Models\Dosis;
use App\Models\Paciente;
use App\Models\Vacuna;

class DosisController
{
    public $authMiddleware;

    public function __construct() {
        // Inicializar el middleware de autenticación
        $this->authMiddleware = new AuthMiddleware;
        $this->authMiddleware->handle();
    }

    public function index()
    {
        $dosis = Dosis::all();

        return view(
            'dosis.home', 
            ["dosis" => $dosis],
            'principal'
        );
    }

    public function crear()
    {
        return view('dosis.create', [], 'principal');
    }

    public function buscarPaciente(Request $request)
    {
        $data = $request->post();

        if(!$data) redirect('/');

        try {
            $cedula = $data->nacionalidad.$data->cedula;
    
            $paciente = Paciente::findByCI($cedula);

            if($paciente) {
                redirect("dosis/asignar/{$paciente->id}");
            }else {
                redirect('dosis/crear', ["error" => "El paciente ingresado no existe"]);
            }
    
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function asignar($id)
    {
        $paciente = Paciente::find($id);

        return view('dosis.create', [
            "paciente" => $paciente,
            "vacunas" => Vacuna::all()
        ], 'principal');
    }

    public function store(Request $request)
    {
        $data = $request->post();

        if(!$data) redirect('/');

        try {

            $paciente = Paciente::find($data->paciente);
            $vacuna = Vacuna::find($data->vacuna);

            $dosis = new Dosis;
            $dosis->paciente = $paciente;
            $dosis->vacuna = $vacuna;
            date_default_timezone_set('America/Caracas');
            $dosis->fecha_aplicacion = date('Y-m-d');
            $dosis->save();

            $vacuna->decreaseOne();
            redirect('dosis', ["message" => "Dosis registrada con exito"]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        Dosis::find($id)->delete();

        redirect('dosis', ["message" => "La dosis fue eliminada de los registros"]);
    }
}