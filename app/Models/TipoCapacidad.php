<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoCapacidad extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_capacidads';
    protected $fillable = [
        'nombre',
    ];

    public function capacidades()
    {
        return $this->hasMany(CapacidadesTrabajo::class, 'id_tipo_capacidad');
    }
}
