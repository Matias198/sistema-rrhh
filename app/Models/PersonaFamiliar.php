<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class PersonaFamiliar extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

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
