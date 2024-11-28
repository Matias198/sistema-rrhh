<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoDocumento extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;
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
