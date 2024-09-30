<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoReqs extends Model
{
    use HasFactory;

    public function requerimientoTrabajo(){
        return $this->belongTo(RequerimientoTrabajo::class);
    }

    public function puestoTrabajo(){
        return $this->belongTo(PuestoTrabajo::class);
    }
}
