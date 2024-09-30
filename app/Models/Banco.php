<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre'
    ];

    public function cuentasBancarias(){
        return $this->hasMany(CuentaBanco::class);
    }
}
