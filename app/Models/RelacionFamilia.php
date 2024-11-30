<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class RelacionFamilia extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'relaciones_familiares';

    protected $fillable = [
        'nombre',
    ];

    // uno a muchos con tabla Contacto_Emergencia
    public function contacto_emergencia()
    {
        return $this->hasMany(ContactoEmergencia::class, 'id_tipo_relacion');
    }

}
