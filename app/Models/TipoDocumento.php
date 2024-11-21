<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipos_documentos';

    protected $fillable = [
        'nombre', 
    ];

    // 1:M Documentos certificados
    public function documentosCertificados()
    {
        return $this->hasMany(DocumentoCertificado::class, 'id_tipo_documento');
    }
}
