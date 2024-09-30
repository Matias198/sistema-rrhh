<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function requerimientoTrabajo(){
        return $this->belongsToMany(RequerimientoTrabajo::class);
    }

    public function puestoFuncion(){
        return $this->belongsToMany(PuestoFuncion::class);
    }

    public function dptoTrabajo(){
        return $this->belongsTo(DptoTrabajo::class, 'id_dpto');
    }
    public function persona(){
        return $this->hasMany(Persona::class);
    }
}
