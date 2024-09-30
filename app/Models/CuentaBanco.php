<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBanco extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_cuenta', 
    ];
    // Define la relación con el modelo Banco
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    // Define la relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    // Define la relación con el modelo TipoBanco
    public function tipoBanco()
    {
        return $this->belongsTo(TipoBanco::class);
    }
}
