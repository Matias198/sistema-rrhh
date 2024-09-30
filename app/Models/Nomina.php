<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'apellido_nombre',
        'legajo',
        'cuil',
        'trabajo_categoria',
        'trabajo_division',
        'trabajo_dpto',
        'f_ingreso',
        'sueldo',
        'liq_tipo_mes_año',
        'jubilado_periodo',
        'jubilado_fecha',
        'jubilado_banco',
        'pago_lugar_fecha',
        'acreditacion_banco',
        'acreditacion_cuenta',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function nominaDetalle()
    {
        return $this->hasMany(NominaDetalle::class);
    }
}
