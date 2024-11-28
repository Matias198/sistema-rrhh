<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contrato extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $table = 'contratos';
    protected $fillable = [
        'nombre_archivo',
        'hora_entrada',
        'hora_salida',
        'sueldo',
        'fecha_ingreso',
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
