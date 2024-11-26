<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacidadesTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Muchos a muchos con puesto de trabajo
    public function puestosTrabajos()
    {
        return $this->belongsToMany(PuestoTrabajo::class, 'puesto_trabajo_capacidades_trabajo', 'id_capacidades_trabajo', 'id_puesto_trabajo');
    }

    // Muchos a uno con tipo de capacidad
    public function tipoCapacidad()
    {
        return $this->belongsTo(TipoCapacidad::class, 'id_tipo_capacidad');
    }

    // Muchos a muchos con empleados
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleados_capacidades', 'id_capacidad', 'id_empleado');
    }
}
