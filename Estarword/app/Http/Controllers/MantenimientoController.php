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
}
