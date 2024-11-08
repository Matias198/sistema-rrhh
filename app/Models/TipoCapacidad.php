<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCapacidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
    ];

    public function capacidades()
    {
        return $this->hasMany(CapacidadesTrabajo::class, 'id_tipo_capacidad');
    }
}
