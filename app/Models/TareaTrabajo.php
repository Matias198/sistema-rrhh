<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TareaTrabajo extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'tarea_trabajos';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Muchos a muchos con puesto de trabajo
    public function puestosTrabajos()
    {
        return $this->belongsToMany(PuestoTrabajo::class, 'puesto_trabajo_tarea_trabajo', 'id_tarea_trabajo', 'id_puesto_trabajo');
    }
}
