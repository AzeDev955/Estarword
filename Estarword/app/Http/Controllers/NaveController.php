<?php

namespace App\Http\Controllers;

use App\Models\Nave;
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

    public function show() : {
        
    }
}
