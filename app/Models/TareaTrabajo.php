<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaTrabajo extends Model
{
    use HasFactory;

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
