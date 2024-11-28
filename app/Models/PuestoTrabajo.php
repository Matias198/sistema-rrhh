<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PuestoTrabajo extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'puesto_trabajos';
    protected $fillable = [
        'titulo_puesto',
        'descripcion_generica',
        'sueldo_base',
        'id_departamento_trabajo',
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
