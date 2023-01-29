<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Models\Vacuna;

class VacunasController
{
    public function index()
    {
        $vacunas = Vacuna::all();
        
        return view('vacunas.home', ["vacunas" => $vacunas], 'principal');
    }

    public function crear()
    {
        return view('vacunas.create', [], 'principal');
    }

    public function editar($id)
    {
        $vacuna = Vacuna::find($id);

        return view('vacunas.edit', ["vacuna" => $vacuna], 'principal');
    }

    public function ver($id)
    {
        $vacuna = Vacuna::find($id);
        return view('vacunas.show', ["vacuna" => $vacuna], 'principal');
    }

    public function store(Request $request)
    {
        $data = $request->post();
        
        if(!$data) redirect('/');

        try {
            $vacuna = recast(Vacuna::class, $data);
            $vacuna->save();

            redirect("vacunas/ver/{$vacuna->id}", ["success" => "Agregado exitosamente!"]);
        } catch (\Throwable $th) {
            throw $th->__toString();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->post();

        if(!$data) redirect('/');

        $vacuna = Vacuna::find($id);

        try {
            $vacuna->update([
                "nombre" => $data->nombre,
                "descripcion" => $data->descripcion,
                "fecha" => $data->fecha,
                "fecha_vencimiento" => $data->fecha_vencimiento
            ]);

            redirect("vacunas/ver/{$vacuna->id}", ["success" => "Los datos fueron actualizados exitosamente"]);
        } catch (\Throwable $th) {
            throw $th->__toString();
        }
    }

    public function delete($id)
    {
        $vacuna = Vacuna::find($id);
        $vacuna->delete();
        redirect('vacunas', ["message" => "El registro de vacunas fue eliminado"]);
    }
}