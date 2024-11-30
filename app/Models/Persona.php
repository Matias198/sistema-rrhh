<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Persona extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'personas';
    protected $fillable = [
        'nombre',
        'segundo_nombre',
        'apellido',
        'dni',
        'cuil',
        'calle',
        'departamento',
        'altura',
        'fecha_nacimiento',
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'id_sexo');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'id_estado_civil');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function obrasSociales()
    {
        return $this->belongsToMany(ObraSocial::class, 'personas_obras_sociales', 'id_persona', 'id_obra_social')
            ->withPivot('numero_afiliado');
    }

    // M:M con familiares
    public function familiares()
    {
        return $this->belongsToMany(Familiar::class, 'personas_familiares', 'id_persona', 'id_familiar')
            ->withPivot('detalle', 'estado', 'id_tipo_relacion')
            ->wherePivot('estado', true);

    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_persona');
    }

    public function documentosCertificados()
    {
        return $this->hasMany(DocumentoCertificado::class, 'id_persona');
    }

    public function contactosEmergencia()
    {
        return $this->hasMany(ContactoEmergencia::class, 'id_persona');
    }

    public function capacidadesTrabajos()
    {
        return $this->hasMany(CapacidadesTrabajo::class, 'id_persona');
    }

    public function getFoto(){
        if ($this->sexo->nombre == 'Masculino') {
            return asset("./img/masculino.webp");
        } elseif ($this->sexo->nombre == 'Femenino') {
            return asset("./img/femenino.webp");
        } else {
            return asset("./img/apache.webp");
        }
    }
}
