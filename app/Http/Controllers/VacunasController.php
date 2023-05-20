<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Http\Request;
use App\Models\Vacuna;

class VacunasController
{
    public function index()
    {
        if(!Auth::hasPermission('vacunas.consultar')) redirect('');
        $vacunas = Vacuna::all();
        
        return view('vacunas.home', ["vacunas" => $vacunas], 'principal');
    }

    public function crear()
    {
        if(!Auth::hasPermission('vacunas.crear')) redirect('');
        return view('vacunas.create', [], 'principal');
    }

    public function editar($id)
    {
        if(!Auth::hasPermission('vacunas.actualizar')) redirect('');
        $vacuna = Vacuna::find($id);

        return view('vacunas.edit', ["vacuna" => $vacuna], 'principal');
    }

    public function ver($id)
    {
        if(!Auth::hasPermission('vacunas.consultar')) redirect('');
        $vacuna = Vacuna::find($id);
        return view('vacunas.show', ["vacuna" => $vacuna], 'principal');
    }

    public function store(Request $request)
    {
        if(!Auth::hasPermission('vacunas.crear')) redirect('');
        $data = $request->post();
        
        if(!$data) redirect('');

        try {
            $vacuna = recast(Vacuna::class, $data);
            $vacuna->save();

            redirect("vacunas/ver/{$vacuna->id}", ["success" => "Agregado exitosamente!"]);
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::hasPermission('vacunas.actualizar')) redirect('');
        $data = $request->post();

        if(!$data) redirect('');

        $vacuna = Vacuna::find($id);

        try {
            $vacuna->update([
                "nombre" => $data->nombre,
                "descripcion" => $data->descripcion,
                "cantidad" => $data->cantidad,
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
        if(!Auth::hasPermission('vacunas.eliminar')) redirect('');
        $vacuna = Vacuna::find($id);
        $vacuna->delete();
        redirect('vacunas', ["message" => "El registro de vacunas fue eliminado"]);
    }
}