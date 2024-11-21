<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRelacion extends Model
{
    use HasFactory;

    protected $table = 'tipos_relaciones';

    protected $fillable = [
        'nombre',
    ];

    // uno a muchos con tabla intermedia Personas_Familiares
    public function personas_familiares()
    {
        return $this->hasMany(PersonaFamiliar::class, 'id_tipo_relacion');
    }
}
