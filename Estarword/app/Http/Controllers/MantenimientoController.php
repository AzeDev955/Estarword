<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        return $mantenimientos;
    }
    public function show($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        return $mantenimiento;
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nave_id' => 'required|exists:naves,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:512',
            'coste' => 'required|numeric|min:0'
        ]);
        $mantenimiento = Mantenimiento::create($datosValidados);
        return response()->json($mantenimiento, 201);

    }

    public function listarPorFechas(Request $request)
    {
        $datosValidados = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $mantenimientos = Mantenimiento::whereBetween(
            'fecha',
            [
                $datosValidados['fecha_inicio'],
                $datosValidados['fecha_fin']
            ]
        );

        return $mantenimientos;
    }
}
