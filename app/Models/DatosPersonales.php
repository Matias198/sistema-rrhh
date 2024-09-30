<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'telefono',
        'estado_civil',
        'cantidad_hijos',
    ];

    public function obtenerPersona(){
        return $this->belongsTo(Persona::class);
    }
}
