<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoJornada extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_jornadas';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_tipo_jornada');
    }
}
