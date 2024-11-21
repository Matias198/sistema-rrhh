<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaFamiliar extends Model
{
    use HasFactory;

    protected $table = 'personas_familiares';

    protected $fillable = [
        'id_persona',
        'id_familiar',
        'id_tipo_relacion',
        'detalle',
        'estado',
    ];

    // uno a muchos con tabla intermedia Personas_Familiares
    public function tipo_relacion()
    {
        return $this->belongsTo(TipoRelacion::class, 'id_tipo_relacion');
    }
}
