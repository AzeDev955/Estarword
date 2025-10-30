<?php

use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\PlanetaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('naves', NaveController::class);
Route::apiResource('planetas', PlanetaController::class);
Route::apiResource('pilotos', PilotoController::class);
Route::apiResource('mantenimientos', MantenimientoController::class);

Route::post('/naves/asignar-piloto', [NaveController::class, 'asignarPiloto']);
Route::post('/naves/desasignar-piloto', [NaveController::class, 'desasignarPiloto']);
Route::get('/naves/inactivas')
/*
Route::get('/naves', [NaveController::class, 'index']);
Route::get('/naves/{id}', [NaveController::class, 'show']);
Route::post('/naves', [NaveController::class, 'store']);
Route::match(['put', 'patch'], '/naves/{id}', [NaveController::class, 'update']);
Route::delete('/naves/{id}', [NaveController::class, 'destroy']);
 */


