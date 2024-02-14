<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $fillable = ['dui', 'nombre', 'email', 'fecha_nacimiento', 'telefono'];

    protected $table = 'visitantes';

    public $timestamps = false;
}
