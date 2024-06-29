<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
    protected $fillable = [
        'documento',
        //'expedicion',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        //'genero',
        'localidad_id',
        'genero_id',
        'expedicion_ci_id',
        //'nacionalidad',
        'direccion',
        'telefono',
        'correo',
        'nombre_referencia',
        'telefono_referencia',
        'fecha_registro',
        'estado',
    ];

    protected $attributes = [
        'estado' => 1,
    ];

    protected $appends = ['estado_texto'];

    public function getEstadoTextoAttribute() //Cada Appendes necesita una funcion get
    {
        $estado_texto = '';
        switch ($this->estado) {
            case 1:
                $estado_texto = 'ACTIVO';
                break;
            case 0:
                $estado_texto = 'INACTIVO';
                break;
        }
        return $estado_texto;
    }
}
