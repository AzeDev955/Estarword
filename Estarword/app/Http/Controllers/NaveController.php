<?php

namespace App\Http\Controllers;

use App\Models\Nave;
use App\Models\Piloto;
use Illuminate\Http\Request;

class NaveController extends Controller
{
    public function index()
    {
        $naves = Nave::all();
        return response()->json($naves); //se puede poner directamente return $naves y laravel solo lo convierte en JSON al estar trabajando con API! 
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'modelo' => 'required|string',
            'tripulacion' => 'required|integer',
            'pasajeros' => 'required|integer',
            'clase' => 'required|string',
            'planeta_id' => 'required|exists:planetas,id'
        ]);

        /*
            if ($datosValidados) {
                        $nave = Nave::create($datosValidados);
                        return response()->json($nave, 201);
                    } else {
                        return response()->json('Ha ocurrido un error con los datos introducidos');
                    }
            Con laravel no es necesario esto ya que el propio validate se encarga de hacerlo solo
        */
        $nave = Nave::create($datosValidados);
        return response()->json($nave, 201);

    }

    public function show($id)
    {
        $nave = Nave::findOrFail($id); //asi devuelve automaticamente un error 404 si no existe el id dentro de la database

        return $nave;
    }

    public function update(Request $request, Nave $nave)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'modelo' => 'required|string',
            'tripulacion' => 'required|integer',
            'pasajeros' => 'required|integer',
            'clase' => 'required|string',
            'planeta_id' => 'required|exists:planetas,id'
        ]);

        $nave->update($datosValidados);
        return $nave;
    }

    public function destroy(Nave $nave)
    {
        $nave->delete();
        return response()->json(null, 204);
    }

    public function asignarPiloto(Request $request)
    {
        $datosValidados = $request->validate([
            'id_piloto' => 'required|exists:pilotos,id',
            'id_nave' => 'required|exists:naves,id'
        ]);

        $nave = Nave::find($datosValidados['id_nave']);
        $piloto = Piloto::find($datosValidados['id_piloto']);
        $nave->pilotos()->attach($datosValidados['id_piloto'], ['fecha_inicio' => now()]);

        return response()->json([
            'exito' => true,
            'mensaje' => "Piloto {$piloto->id} asignado a la nave {$nave->id}"
        ]);
    }

    public function desasignarPiloto(Request $request)
    {
        $datosValidados = $request->validate([
            'id_piloto' => 'required|exists:pilotos,id',
            'id_nave' => 'required|exists:naves,id'
        ]);

        $nave = Nave::find($datosValidados['id_nave']);
        $piloto = Piloto::find($datosValidados['id_piloto']);
        /*
        mi intento
         $resultado = $nave->pilotos()->updateExistingPivot($datosValidados['id_piloto'], ['fecha_fin' => now()]);
        */
        $resultado = $nave->pilotos()
            ->wherePivotNull('fecha_fin')
            ->updateExistingPivot($datosValidados['id_piloto'], ['fecha_fin' => now()]);
        if ($resultado) {
            return response()->json([
                'exito' => true,
                'mensaje' => "Piloto {$piloto->id} desasignado a la nave {$nave->id}"
            ], 201);
        }
        return response()->json([
            'exito' => false,
            'mensaje' => 'Error: El piloto no tiene una asignación activa en esta nave.'
        ], 404);

    }
}
