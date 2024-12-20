<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ObraSocial extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'obras_sociales';

    protected $fillable = [
        'nombre',
    ];

    // Muchos a muchos con personas y pivot numero_afiliado en la tabla personas_obras_sociales
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'personas_obras_sociales', 'id_obra_social', 'id_persona')
            ->withPivot('numero_afiliado');
    }
}
