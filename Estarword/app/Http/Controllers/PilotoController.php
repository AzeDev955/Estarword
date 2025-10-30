<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
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
}
