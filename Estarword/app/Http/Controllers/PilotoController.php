<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use App\Models\Pilotos_nave;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
    public function index()
    {
        $pilotos = Piloto::all();
        return $pilotos;
    }
    public function show($id)
    {
        $piloto = Piloto::find($id);
        return $piloto;
    }

    public function listarHistorico()
    {
        $pilotosConHistorial = Piloto::has('naves')->get();
        return $pilotosConHistorial;
    }

    public function listarActuales()
    {
        $pilotosActivos = Piloto::whereHas('naves', function ($query) {
            $query->whereNull('pilotos_naves.fecha_fin');
        })->with([
                    'naves' => function ($query) {
                        $query->whereNull('pilotos_naves.fecha_fin');
                    }
                ])->get();

        return $pilotosActivos;
    }
}
