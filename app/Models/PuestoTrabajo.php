<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo_puesto',
        'descripcion_puesto',
        'sueldo_base',
    ];

    // Muchos a muchos con tareas de trabajo
    public function tareasTrabajos()
    {
        return $this->belongsToMany(TareaTrabajo::class, 'puesto_trabajo_tarea_trabajo', 'id_puesto_trabajo', 'id_tarea_trabajo');
    }

    // Uno a muchos con departamento de trabajo
    public function departamentoTrabajo()
    {
        return $this->belongsTo(DepartamentoTrabajo::class, 'id_departamento_trabajo');
    }

    // Muchos a muchos con capacidades de trabajo agregando la columna "excluyente"
    public function capacidadesTrabajos()
    {
        return $this->belongsToMany(CapacidadesTrabajo::class, 'puesto_trabajo_capacidades_trabajo', 'id_puesto_trabajo', 'id_capacidades_trabajo')->withPivot('excluyente');
    }
}
