<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    use HasFactory;

    protected $table = 'familiares';

    protected $fillable = [
        'nombre',
        'apellido',
        'sexo',
        'dni',
        'fecha_nacimiento',
    ];

    // Muchos a muchos con Personas agregando la columna "detalle, estado, id_tipo_relacion"
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'familiares_persona', 'id_familiar', 'id_persona')->withPivot('detalle', 'estado', 'id_tipo_relacion');
    }
}
