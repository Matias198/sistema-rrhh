<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor_auxiliar', 
    ];
    public function nomina()
    {
        return $this->belongsTo(Nomina::class);
    }

    // Define la relación con el modelo TipoBanco
    public function detalle()
    {
        return $this->belongsTo(Detalle::class);
    }
}
