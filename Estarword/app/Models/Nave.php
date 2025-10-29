<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nave extends Model
{
    /** @use HasFactory<\Database\Factories\NaveFactory> */
    use HasFactory;
    protected $fillable = [
        'nombre',
        'modelo',
        'tripulacion',
        'pasajeros',
        'clase',
        'planeta_id'
    ];
    public function planeta(): BelongsTo
    {
        return $this->belongsTo(Planeta::class);
    }

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function pilotos(): BelongsToMany
    {
        return $this->belongsToMany(Piloto::class, 'pilotos_naves')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }

}
