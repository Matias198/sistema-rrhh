<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoJornada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_tipo_jornada');
    }
    
}
