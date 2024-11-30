<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoRelacion extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'tipos_relaciones';

    protected $fillable = [
        'nombre',
    ];

    // uno a muchos con tabla intermedia Personas_Familiares
    public function personas_familiares()
    {
        return $this->hasMany(PersonaFamiliar::class, 'id_tipo_relacion');
    }
    // uno a muchos con tabla Familiares
    public function familiares()
    {
        return $this->hasMany(Familiar::class, 'id_tipo_relacion');
    }
}
