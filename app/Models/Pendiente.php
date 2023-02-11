<?php

namespace App\Models;

use App\DB\DB;

use App\Models\Paciente;
use App\Models\Vacuna;

class Pendiente
{   
    public $id;
    public $vacuna;
    public $paciente;
    public $fecha_prevista;

    public static function all()
    {
        $data = DB::select("SELECT * FROM vacunas_pendientes");

        $pendientes = [];

        foreach($data as $value){
            $object = (object)[
                "id" => $value["id"],
                "paciente" => Paciente::find($value["id_persona"]),
                "vacuna" => Vacuna::find($value["id_vacuna"]),
                "fecha_prevista" => $value["fecha_prevista"]
            ];

            $instance = recast(Pendiente::class, $object);

            $pendientes[] = $instance;
        }

        return $pendientes;
    }

    public function save()
    {
        $id = DB::insert('vacunas_pendientes', [
            "id_persona" => $this->paciente->id,
            "id_vacuna" => $this->vacuna->id,
            "fecha_prevista" => $this->fecha_prevista
        ]);

        $this->id = $id;
    }
}