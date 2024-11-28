<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Pais extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'pais';
    protected $fillable = [
        'codigo',
        'nombre',
    ];

    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'id_pais');
    }
}
