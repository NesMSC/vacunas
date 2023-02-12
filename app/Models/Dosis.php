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
    public $fecha_aplicacion;

    public static function all()
    {
        $data = DB::select("SELECT * FROM dosis");

        $array_dosis = [];

        foreach ($data as $value) {
            $dosis = new Dosis;
            $dosis->id = $value['id'];
            $dosis->paciente = Paciente::find($value['id_persona']);
            $dosis->vacuna = Vacuna::find($value['id_vacuna']);
            $dosis->fecha_aplicacion = $value['fecha_aplicacion'];

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
            $dosis->fecha_aplicacion = $data[0]['fecha_aplicacion'];
            return $dosis;
        }

    }

    public function save()
    {
        $id = DB::insert('dosis', [
            "id_persona" => $this->paciente->id,
            "id_vacuna" => $this->vacuna->id,
            "fecha_aplicacion" => $this->fecha_aplicacion
        ]);

        $this->deleteDosisFromPendientes();

        $this->id = $id;
    }

    public function delete()
    {
        DB::delete('dosis', 'id', '=', $this->id);
    }

    public static function today()
    {
        $dosis_totales = self::all();

        date_default_timezone_set('America/Caracas');
        $now = date('Y-m-d');;
    
        $dosis_del_dia = array_filter($dosis_totales, function(Dosis $dosis) use ($now) {

            return $dosis->fecha_aplicacion == $now;
        });

        return $dosis_del_dia;
    }

    private function deleteDosisFromPendientes()
    {
        $pendientes = $this->paciente->pendientes;
        $vacuna = $this;

        $pendiente = array_filter($pendientes, function (Pendiente $pendiente) use ($vacuna) {
            return $vacuna->id = $pendiente->vacuna->id;
        });

        if(!empty($pendiente)) {
            $pendiente[0]->delete();
        }
    }
}