<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_archivo',
        'fecha_vencimiento',
        'estado',
        'id_tipo_contrato',
        'id_tipo_jornada',
        'id_empleado',
    ];

    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'id_tipo_contrato');
    }

    public function tipoJornada()
    {
        return $this->belongsTo(TipoJornada::class, 'id_tipo_jornada');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}
