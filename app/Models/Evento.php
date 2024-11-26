<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;



class Evento extends Model
{
    use HasFactory;
    use SoftDeletes;
    //use \OwenIt\Auditing\Auditable;
    protected $fillable = ['title', 'start', 'end'];
    
    /** 
    public function usuario()    {
        return $this->belongsTo(User::class, 'id_usuario');
    }*/
    
}

