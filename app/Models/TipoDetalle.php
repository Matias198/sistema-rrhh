<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDetalle extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'nombre',  
    ];

    public function detalle()
    {
        return $this->hasMany(Detalle::class);
    }
}
