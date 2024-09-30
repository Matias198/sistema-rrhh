<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 
        'nombre', 
        'valor_default', 
    ];

    public function nominaDetalle()
    {
        return $this->hasMany(NominaDetalle::class);
    }
    public function tipoDetalle()
    {
        return $this->belongsTo(TipoDetalle::class);
    }
}
