<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Evento extends Model
{
    protected $fillable = ['event_name', 'start_date', 'end_date'];
    use HasFactory;
}
