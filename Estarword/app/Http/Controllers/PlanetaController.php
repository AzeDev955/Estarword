<?php

namespace App\Http\Controllers;

use App\Models\Planeta;
use Illuminate\Http\Request;

class PlanetaController extends Controller
{
    public function index()
    {
        $planetas = Planeta::all();
        return $planetas;
    }
    public function show($id)
    {
        $planeta = Planeta::find($id);
        return $planeta;
    }
}
