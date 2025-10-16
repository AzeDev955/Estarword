<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{

    protected $fillable = [
        'nombre',
        'altura',
        'genero',
        "ano_nacimiento",
    ];
    public function navesHistorico()
    {
        return $this->belongsToMany(Nave::class, 'piloto_nave', 'piloto_id', 'nave_id')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
    public function navesActuales()
    {
        return $this->belongsToMany(Nave::class, 'piloto_nave', 'piloto_id', 'nave_id')
            ->wherePivotNull('fecha_fin')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
}
