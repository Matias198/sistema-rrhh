<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Familiar extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'familiares';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
    ];

    // Muchos a muchos con Personas agregando la columna "detalle, estado, id_tipo_relacion"
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'personas_familiares', 'id_familiar', 'id_persona')
            ->withPivot('detalle', 'estado', 'id_tipo_relacion')
            ->wherePivot('estado', true);
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'id_sexo');
    }

    public function tipoRelacion()
    {
        return $this->belongsTo(TipoRelacion::class, 'id_tipo_relacion');
    }
}
