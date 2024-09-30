<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionTrabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function puestoFuncion(){
        return $this->hasMany(PuestoFuncion::class);
    }

}
