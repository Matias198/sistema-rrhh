<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
    ]; 
    public function provincias()
    {
        return $this->belongsTo(Provincia::class, 'id_provincia'); 
    }

    public function personas()
    {
        return $this->hasMany(Persona::class, 'id_municipio');
    }
}
