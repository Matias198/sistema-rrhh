<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class EstadoCivil extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $table = 'estado_civils';
    protected $fillable = ['nombre'];

    public function personas()
    {
        return $this->hasMany(Persona::class, 'id_estado_civil');
    }
}
