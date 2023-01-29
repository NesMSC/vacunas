<?php

namespace App\Models;

use App\DB\DB;

class Vacuna
{
    public $id;
    public $nombre;
    public $descripcion;
    public $fecha;
    public $fecha_vencimiento;

    public static function all()
    {
        $data = DB::select("SELECT * FROM vacunas");

        $vacunas = array_map(fn($vacuna) => recast(Vacuna::class, (object)$vacuna), $data);

        return $vacunas;
    }

    public static function find($id)
    {
        $data = DB::select("SELECT * FROM vacunas WHERE id=$id");

        try {
            $vacuna = recast(Vacuna::class, (object)$data[0]);
            return $vacuna;
        } catch (\Throwable $th) {
            throw $th->__toString();
        }

    }

    public function save()
    {
        $id = DB::insert('vacunas', [
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "fecha" => $this->fecha,
            "fecha_vencimiento" => $this->fecha_vencimiento
        ]);

        $this->id = $id;
    }

    public function update($data)
    {
        DB::update('vacunas', $data, $this->id);
    }

    public function delete()
    {
        DB::delete('vacunas', 'id', '=', $this->id);
    }

    public function getEstado()
    {
        $now = new \DateTime();
        $inputDate = new \DateTime($this->fecha_vencimiento);
        return $inputDate > $now;
    }
}