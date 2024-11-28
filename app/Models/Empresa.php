<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Empresa extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'razon_social',
        'cuit',
        'inicio_actividades',
        'ubicacion',
        'telefono',
        'email',
    ];
}
