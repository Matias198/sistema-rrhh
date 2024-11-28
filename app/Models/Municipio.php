<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Municipio extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'municipios';
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
