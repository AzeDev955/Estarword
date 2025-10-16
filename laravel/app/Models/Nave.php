<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nave extends Model
{
    protected $fillable = [
        "nombre",
        "modelo",
        "tripulacion",
        "pasajeros",
        "clase_nave",
    ];
    public function planeta()
    {
        return $this->belongsTo(Planeta::class, 'planeta_id');
    }
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'nave_id');
    }

    public function pilotosHistorico()
    {
        return $this->belongsToMany(Piloto::class, 'piloto_nave', 'nave_id', 'piloto_id')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
    public function pilotosActuales()
    {
        return $this->belongsToMany(Piloto::class, 'piloto_nave', 'nave_id', 'piloto_id')
            ->wherePivotNull('fecha_fin')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
}
