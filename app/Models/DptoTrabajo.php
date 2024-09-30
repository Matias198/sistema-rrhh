<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DptoTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function puestoTrabajo(){
        return $this->hasMany(PuestoTrabajo::class);
    }
}
