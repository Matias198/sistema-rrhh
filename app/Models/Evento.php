<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Evento extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $table = 'eventos';
    protected $fillable = [
        'grupo',
        'fecha_inicio',
        'fecha_fin',
        'titulo',
        // 'url',
        'color',
    ];

    // Relacion M:M con personas
    public function usuarios(){
        return $this->belongsToMany(User::class, 'usuarios_eventos', 'id_evento', 'id_user');
    }
}
