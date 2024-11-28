<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DepartamentoTrabajo extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'departamento_trabajos';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Uno a muchos con puestos de trabajo
    public function puestosTrabajos()
    {
        return $this->hasMany(PuestoTrabajo::class, 'id_departamento_trabajo');
    }
}
