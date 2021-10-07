<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paracaidista extends Model
{
    use HasFactory;
    protected $fillable = ['cedula','nombre','apellido','fecha_nacimiento','telefono','direccion'];

}
