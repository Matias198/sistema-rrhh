<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoFuncion extends Model
{
    use HasFactory;

    public function funcionTrabajo(){
        return $this->belongTo(FuncionTrabajo::class);
    }

    public function puestoTrabajo(){
        return $this->belongTo(PuestoTrabajo::class);
    }
}
