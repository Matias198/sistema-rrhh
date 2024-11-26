<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'legajo',
        'fecha_ingreso',
        'estado_laboral',
        'id_persona',
        'id_puesto',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function puesto()
    {
        return $this->belongsTo(PuestoTrabajo::class, 'id_puesto_trabajo');
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id_empleado');
    } 

    // Muchos a muchos con capacidades
    public function competencias()
    {
        return $this->belongsToMany(CapacidadesTrabajo::class, 'empleados_capacidades', 'id_empleado', 'id_capacidad');
    }
}
