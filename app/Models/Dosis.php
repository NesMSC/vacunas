<?php

namespace App\Models;

use App\DB\DB;
use App\Models\Paciente;
use App\Models\Vacuna;

class Dosis 
{
    public $id;
    public Paciente $paciente;
    public Vacuna $vacuna;
    public $fecha_aplicación;

    public static function all()
    {
        $data = DB::select("SELECT * FROM dosis");

        $array_dosis = [];

        foreach ($data as $value) {
            $dosis = new Dosis;
            $dosis->id = $value['id'];
            $dosis->paciente = Paciente::find($value['id_persona']);
            $dosis->vacuna = Vacuna::find($value['id_vacuna']);
            $dosis->fecha_aplicación = $value['fecha_aplicacion'];

            $array_dosis[] = $dosis;
        }

        return $array_dosis;
    }

    public static function find($id)
    {
        $data = DB::select("SELECT * FROM dosis WHERE id=$id");

        if(count($data)) {
            $dosis = new Dosis;
            $dosis->id = $data[0]['id'];
            $dosis->paciente = Paciente::find($data[0]['id_persona']);
            $dosis->vacuna = Vacuna::find($data[0]['id_vacuna']);
            $dosis->fecha_aplicación = $data[0]['fecha_aplicacion'];
            return $dosis;
        }

    }

    public function save()
    {
        $id = DB::insert('dosis', [
            "id_persona" => $this->paciente->id,
            "id_vacuna" => $this->vacuna->id,
            "fecha_aplicacion" => $this->fecha_aplicación
        ]);

        $this->id = $id;
    }

    public function delete()
    {
        DB::delete('dosis', 'id', '=', $this->id);
    }
}