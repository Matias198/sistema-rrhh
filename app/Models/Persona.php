<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        's_nombre',
        'apellido',
        'cuil',
        'legajo',
        'dni',
        'fehca_nac',
        'fecha_ingreso',
    ];

    public function puestoTrabajo(){
        return $this->belongsTo(PuestoTrabajo::class);
    }

    public function contactoEmergencia(){
        return $this->hasMany(ContactoEmergencia::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function datosPersonales(){
        return $this->hasOne(DatosPersonales::class);
    }

    public function cuentasBancarias()
    {
        return $this->hasMany(CuentaBanco::class, 'id_tipo');
    }

    public function nomina(){
        return $this->hasMany(Nomina::class);
    }
}
