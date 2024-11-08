<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoTrabajo extends Model
{
    use HasFactory;

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
