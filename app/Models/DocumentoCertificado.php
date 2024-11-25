<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoCertificado extends Model
{
    use HasFactory;

    protected $table = 'documentos_certificados';

    protected $fillable = [
        'id_tipo_documento',
        'id_persona',
        'nombre_archivo',
        'detalle',
        'estado'
    ];

    // M:1 Tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento');
    }

    // M:1 Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

}
