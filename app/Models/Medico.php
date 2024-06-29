<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos'; // Nombre de la tabla

    protected $fillable = [ // Campos que se pueden asignar masivamente
        'nombre_completo',
        'especialidad',
        'matricula',
        'telefono',
        'direccion',
        'correo',
        'estado'
    ];
}
