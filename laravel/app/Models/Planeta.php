<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planeta extends Model
{
    protected $fillable = [
        "nombre",
        "periodo_rotacion",
        "clima",
        "poblacion"
    ];
    public function naves()
    {
        return $this->hasMany(Nave::class, "planeta_id");
    }
}
