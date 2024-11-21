<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraSocial extends Model
{
    use HasFactory;

    protected $table = 'obras_sociales';

    protected $fillable = [
        'nombre',
    ];

    // Muchos a muchos con personas y pivot numero_afiliado
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'afiliados', 'obra_social_id', 'persona_id')
            ->withPivot('numero_afiliado');
    }

}
